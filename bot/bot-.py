import os
import asyncio
import pymysql.cursors
import ctypes
import re
import sys
import time
import logging
from time import sleep
from twitchio.ext import commands

#---------------------------------------------------------
# Starting script
#---------------------------------------------------------
print('-------------------------------------------')
print('---------- Lurkarts lurker V 3.0 ----------')
print('-------------------------------------------')

#---------------------------------------------------------
# Get streamer name from the command arguments
#---------------------------------------------------------
if len(sys.argv) < 2:
    print("Startup Error: Please provide a streamer name")
    sys.exit(1)
else:
    streamer = sys.argv[1]
    print(time.strftime("%d/%m %H:%M:%S")+"| Listening to twitch streamer: "+streamer)

#---------------------------------------------------------
# Get streamer_id from the command arguments
#---------------------------------------------------------
if len(sys.argv) < 3:
    print("Startup Error: Please provide a streamer id")
    sys.exit(1)
else:
    streamer_id = int(sys.argv[2])
    print(time.strftime("%d/%m %H:%M:%S")+"| Streamer database id: "+str(streamer_id))
    
#---------------------------------------------------------
# Sometimes we need to test from our own account
#---------------------------------------------------------
if streamer == 'scampi_ml':
    lurkarts_bot_name = streamer
    db_config = {
        'mysql_host': '127.0.0.1',
        'mysql_user': 'lurkarts_bot',
        'mysql_password': 'lurkarts_bot',
        'mysql_database': 'lurkarts'
    }
    print(time.strftime("%d/%m %H:%M:%S")+"| !!! WARNING !!! Listening to own account for testing !!! WARNING !!!")
else:
    lurkarts_bot_name = 'lurkarts'
    db_config = {
        'mysql_host': '192.168.30.228',
        'mysql_user': 'lurkarts_bot',
        'mysql_password': 'lurkarts_bot',
        'mysql_database': 'lurkarts'
    }
    print(time.strftime("%d/%m %H:%M:%S")+"| Production mode active")

#---------------------------------------------------------
# Create a nice window(s) title
#---------------------------------------------------------
ctypes.windll.kernel32.SetConsoleTitleW("Lurkarts for "+streamer)

#---------------------------------------------------------
# Create a folder for each streamer, keep things seperated
#---------------------------------------------------------
if not os.path.exists(streamer):
    os.makedirs(streamer)
    print(time.strftime("%d/%m %H:%M:%S")+"| Folder created for streamer: "+streamer)

#---------------------------------------------------------
# Make some logging, comes in handy right?
#---------------------------------------------------------
logging.basicConfig(filename=streamer+'/'+time.strftime("%d-%m-%y")+'_'+'debug.log', level=logging.DEBUG)


class Bot(commands.Bot):

    def __init__(self):
        super().__init__(token='oauth:xxxxxxxxxxxxxxxxxxxxxxxxxxxx', client_id='xxxxxxxxxxxxxxxxxxxxxxxxxxxx', prefix='!', heartbeat=120, initial_channels=["#" + streamer])
        print(time.strftime("%d/%m %H:%M:%S")+"| Connecting to twitch...")
        self.connection = None

        if os.path.isfile(streamer + "_uuid.txt"):
            os.remove(streamer + "_uuid.txt")
            print(time.strftime("%d/%m %H:%M:%S")+"| WARNING: old uuid file found, deleted!")

    #---------------------------------------------------------
    # PyMySQL Database Connector
    #---------------------------------------------------------
    def connect_to_db(self, config):
        try:
            self.connection = pymysql.connect(
                host=config['mysql_host'],
                user=config['mysql_user'],
                password=config['mysql_password'],
                database=config['mysql_database'],
                port=3306,
                charset='utf8',
                connect_timeout=20,
                cursorclass=pymysql.cursors.DictCursor
            )
            print(time.strftime("%d/%m %H:%M:%S")+"| PyMySQL Database connected: "+config['mysql_host'])
        except pymysql.Error as e:
            print(time.strftime("%d/%m %H:%M:%S")+"| PyMySQL ERROR: %d: %s" % (e.args[0], e.args[1]))
            self.connection = None

    #---------------------------------------------------------
    # Getting thhings ready
    #---------------------------------------------------------
    async def event_ready(self):
        print(time.strftime("%d/%m %H:%M:%S")+"| Logged into twitch!")
        print(time.strftime("%d/%m %H:%M:%S")+"| Connecting to database...")
        while self.connection is None:
            self.connect_to_db(db_config)
            if self.connection is None:
                print(time.strftime("%d/%m %H:%M:%S")+"| Failed to connect. Retrying in 5 seconds...")
                time.sleep(5)
        print(time.strftime("%d/%m %H:%M:%S")+"| Program ready...")

    #---------------------------------------------------------
    # Start on events
    #---------------------------------------------------------
    async def event_message(self, message):
        # make sure the bot ignores itself and the streamer
        if message.echo:
            return

        if message.content == "Card raffle incoming, !lurkarts time" and message.author.name.lower() == lurkarts_bot_name:
            print(time.strftime("%d/%m %H:%M:%S")+"| !!!! Lurkarts raffle started !!!!")
            raffle_id = message.id

            with open(streamer + "_uuid.txt", "w") as f:
                f.write(raffle_id)

            with self.connection.cursor() as cur:
                try:
                    self.connection.ping(reconnect=True)
                    sql = "INSERT INTO raffles (raffle_id, streamer_id, raffle_start, created_at) VALUES (%s, %s, %s, %s)"
                    val = (raffle_id, streamer_id, message.timestamp, message.timestamp)
                    cur.execute(sql, val)
                    self.connection.commit()
                    print(time.strftime("%d/%m %H:%M:%S")+"| PyMySQL> Opened the raffle")
                except pymysql.Error as e:
                    print(time.strftime("%d/%m %H:%M:%S")+"| PyMySQL ERROR: %d: %s" % (e.args[0], e.args[1]))

        elif message.author.name.lower() == lurkarts_bot_name:
            if "Raffle results: " in message.content:
                print(time.strftime("%d/%m %H:%M:%S")+"| !!!! Lurkarts raffle ended !!!!")
                with open(streamer + "_uuid.txt", "r") as f:
                    raffle_id = f.read()
                os.remove(streamer + "_uuid.txt")

                with self.connection.cursor() as cur:
                    try:
                        self.connection.ping(reconnect=True)
                        sql = "UPDATE raffles SET raffle_stop = %s WHERE raffle_id = %s"
                        val = (message.timestamp, raffle_id)
                        cur.execute(sql, val)
                        self.connection.commit()
                        print(time.strftime("%d/%m %H:%M:%S")+"| PyMySQL> Closed the raffle")
                    except pymysql.Error as e:
                        print(time.strftime("%d/%m %H:%M:%S")+"| PyMySQL ERROR: %d: %s" % (e.args[0], e.args[1]))

                matches = re.findall(r'@(\w+)\sgot\s([^@]+)', message.content)
                users, items = zip(*[(match[0], re.sub(r'[\U0001F100-\U0001F5FF]', '', match[1]).strip()) for match in matches])

                if users:
                    with self.connection.cursor() as cur:
                        try:
                            self.connection.ping(reconnect=True)
                            sql = "INSERT INTO raffle_wins (raffle_id, streamer_id, user, msg_id, card_name, created_at) VALUES (%s, %s, %s, %s, %s, %s)"
                            val = (raffle_id, streamer_id, users[0], message.id, items[0], message.timestamp)
                            cur.execute(sql, val)
                            self.connection.commit()
                            print(time.strftime("%d/%m %H:%M:%S")+"| PyMySQL> Added winning item 1")
                        except pymysql.Error as e:
                            print(time.strftime("%d/%m %H:%M:%S")+"| PyMySQL ERROR: %d: %s" % (e.args[0], e.args[1]))

                if len(users) > 1:
                    with self.connection.cursor() as cur:
                        try:
                            self.connection.ping(reconnect=True)
                            sql = "INSERT INTO raffle_wins (raffle_id, streamer_id, user, msg_id, card_name, created_at) VALUES (%s, %s, %s, %s, %s, %s)"
                            val = (raffle_id, streamer_id, users[1], message.id, items[1], message.timestamp)
                            cur.execute(sql, val)
                            self.connection.commit()
                            print(time.strftime("%d/%m %H:%M:%S")+"| PyMySQL> Added winning item 2")
                        except pymysql.Error as e:
                            print(time.strftime("%d/%m %H:%M:%S")+"| PyMySQL ERROR: %d: %s" % (e.args[0], e.args[1]))
            
            if "you have already joined this raffle" in message.content:
                print(time.strftime("%d/%m %H:%M:%S") + "| Queue jumper found")
                with open(streamer + "_uuid.txt", "r") as f:
                    raffle_id = f.read()
                match = re.search(r'@(\w+)', message.content)
                username = match.group(1)
                with self.connection.cursor() as cur:
                    try:
                        self.connection.ping(reconnect=True)
                        sql = "INSERT INTO raffle_jump (raffle_id, streamer_id, user, msg_id, created_at) VALUES (%s, %s, %s, %s, %s)"
                        val = (raffle_id, streamer_id, username, message.id, message.timestamp)
                        cur.execute(sql, val)
                        self.connection.commit()
                        print(time.strftime("%d/%m %H:%M:%S")+"| PyMySQL> Added jumper")
                    except pymysql.Error as e:
                        print(time.strftime("%d/%m %H:%M:%S")+"| PyMySQL ERROR: %d: %s" % (e.args[0], e.args[1]))  
            
            # This is a drop, update the users
            if " You got " in message.content:
                print(time.strftime("%d/%m %H:%M:%S") + "| Drop found")
                with open(streamer + "_uuid.txt", "r") as f:
                    raffle_id = f.read()
                    
                # Use a regular expression to find the username
                match_username = re.search(r'@(\w+)', message.content)
                username = match_username.group(1)
                
                if username:
                    # Use a regular expression to find the word (card_name) after "You got "
                    match_card_name = re.search(r'You got (\w+)', message.content)
                    card_name = match_card_name.group(1)
                    
                    # Extract the card name if a match is found
                    if match_card_name:
                        with self.connection.cursor() as cur:
                            try:
                                self.connection.ping(reconnect=True)
                                sql = "INSERT INTO raffle_wins (raffle_id, streamer_id, user, card_name, created_at) VALUES (%s, %s, %s, %s, %s)"
                                val = (raffle_id, streamer_id, username, card_name, message.timestamp)
                                cur.execute(sql, val)
                                self.connection.commit()
                                print(time.strftime("%d/%m %H:%M:%S")+"| PyMySQL> Added drop")
                            except pymysql.Error as e:
                                print(time.strftime("%d/%m %H:%M:%S")+"| PyMySQL ERROR: %d: %s" % (e.args[0], e.args[1]))
                        # Remove the file, so it looks completed
                        os.remove(streamer + "_uuid.txt")
                        print(time.strftime("%d/%m %H:%M:%S")+"| Raffle Closed, uuid deleted!")
                    else:
                        print("")
                        print(time.strftime("%d/%m %H:%M:%S")+"| ERROR: No card_name found")
                else:
                    print("")
                    print(time.strftime("%d/%m %H:%M:%S")+"| ERROR: No username found")
        await self.handle_commands(message)
        
        
    #---------------------------------------------------------
    # Event when !lurkarts in chat
    #---------------------------------------------------------
    @commands.command()
    async def lurkarts(self, ctx: commands.Context):
        print(time.strftime("%d/%m %H:%M:%S")+"| !lurkarts in the chat by: "+ctx.author.name)
        if os.path.isfile(streamer + "_uuid.txt"):
            with open(streamer + "_uuid.txt", "r") as f:
                raffle_id = f.read()
                
            with self.connection.cursor() as cur:
                try:
                    self.connection.ping(reconnect=True)
                    sql = "INSERT INTO raffle_users (raffle_id, streamer_id, user, msg_id, created_at) VALUES (%s, %s, %s, %s, %s)"
                    val = (raffle_id, streamer_id, ctx.author.name, ctx.message.id, ctx.message.timestamp)
                    cur.execute(sql, val)
                    self.connection.commit()
                    print(time.strftime("%d/%m %H:%M:%S")+"| PyMySQL> Added user")
                except pymysql.Error as e:
                    print(time.strftime("%d/%m %H:%M:%S")+"| PyMySQL ERROR: %d: %s" % (e.args[0], e.args[1]))
        else:
            print(time.strftime("%d/%m %H:%M:%S")+"| No active raffles for this channel")
            
            with self.connection.cursor() as cur:
                try:
                    self.connection.ping(reconnect=True)
                    sql = "INSERT INTO raffle_rejects (msg_id, streamer_id, user, created_at) VALUES (%s, %s, %s, %s)"
                    val = (ctx.message.id, streamer_id, ctx.author.name, ctx.message.timestamp)
                    cur.execute(sql, val)
                    self.connection.commit()
                    print(time.strftime("%d/%m %H:%M:%S")+"| PyMySQL> Added rejected user")
                except pymysql.Error as e:
                    print(time.strftime("%d/%m %H:%M:%S")+"| PyMySQL ERROR: %d: %s" % (e.args[0], e.args[1]))

    @commands.command()
    async def drop(self, ctx: commands.Context):
        print(time.strftime("%d/%m %H:%M:%S")+"| !drop in the chat by: "+ctx.author.name)
        if os.path.isfile(streamer + "_uuid.txt"):
            with open(streamer + "_uuid.txt", "r") as f:
                raffle_id = f.read()
                
            with self.connection.cursor() as cur:
                try:
                    self.connection.ping(reconnect=True)
                    sql = "INSERT INTO raffle_drop (raffle_id, streamer_id, user, msg_id, created_at) VALUES (%s, %s, %s, %s, %s)"
                    val = (raffle_id, streamer_id, ctx.author.name, ctx.message.id, ctx.message.timestamp)
                    cur.execute(sql, val)
                    self.connection.commit()
                    print(time.strftime("%d/%m %H:%M:%S")+"| PyMySQL> Added drop user with raffle")
                except pymysql.Error as e:
                    print(time.strftime("%d/%m %H:%M:%S")+"| PyMySQL ERROR: %d: %s" % (e.args[0], e.args[1]))
        else:
            print(time.strftime("%d/%m %H:%M:%S")+"| !drop when no active raffle")
            
            with self.connection.cursor() as cur:
                try:
                    self.connection.ping(reconnect=True)
                    sql = "INSERT INTO raffle_drop (msg_id, streamer_id, user, created_at) VALUES (%s, %s, %s, %s)"
                    val = (ctx.message.id, streamer_id, ctx.author.name, ctx.message.timestamp)
                    cur.execute(sql, val)
                    self.connection.commit()
                    print(time.strftime("%d/%m %H:%M:%S")+"| PyMySQL> Added drop user with no raffle")
                except pymysql.Error as e:
                    print(time.strftime("%d/%m %H:%M:%S")+"| PyMySQL ERROR: %d: %s" % (e.args[0], e.args[1]))

    #---------------------------------------------------------
    # Block any ! commands we dont need in chat
    #---------------------------------------------------------
    async def event_command_error(self, ctx, error: Exception):
        return


bot = Bot()
bot.run()