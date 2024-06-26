import os
import subprocess
import time
import json
import requests

# ANSI escape codes for text colors
color_red = '\033[91m'
color_green = '\033[92m'
color_yellow = '\033[93m'
color_blue = '\033[94m'
color_purple = '\033[95m'
color_reset = '\033[0m'  # Reset text color to default
repo_url = "https://github.com/Soubhik2/CORE-PHP.git"

def init():
    # output = subprocess.run(["rmdir","/s","/q",name+"\\.git"], shell=True, capture_output=True, text=True)
    # if not output.returncode == 0:
    #     print(output.stderr)

    current_directory = os.getcwd()
    arr = current_directory.split("\\")

    path = '/'.join(arr[arr.index("htdocs")+1:])
    path += '/'+name

    # Open the file for reading
    with open(name+'/index.php', 'r') as file:
        # Read the entire contents of the file
        file_contents = file.read()
        # Print the contents

    with open(name+'/index.php', 'w') as f:
        f.write(file_contents.replace("CPHP", path))

    with open(name+'/.htaccess', 'r') as file:
        # Read the entire contents of the file
        file_contents_h = file.read()
        # Print the contents

    with open(name+'/.htaccess', 'w') as f:
        f.write(file_contents_h.replace("CPHP", path))

    print(color_green+"\nProject Initiated"+color_reset)

def set_package(data, command):
    print(color_blue+"installing packages...\n")
    
    # print(data["package"])
    
    time.sleep(1)

    # print(color_purple+"Install Starting..."+color_reset)
    # time.sleep(1)

    with open('config.json', 'r') as file:
        # Read the entire contents of the file
        file_contents = file.read()
        file_contents = json.loads(file_contents)
        # file_contents["dependencies"][command] = {
        #     "enable": False,
        #     "path": "auth"
        # }
        file_contents["dependencies"][command] = data["config"][command]
        file_contents = json.dumps(file_contents, indent=4)
        # print(file_contents)
        # Print the contents

    with open('config.json', 'w') as f:
        f.write(file_contents)
    
    with open('config-lock.json', 'r') as file:
        # Read the entire contents of the file
        file_contents = file.read()
        file_contents = json.loads(file_contents)
        # file_contents["packages"][command] = {
        #     "name": "core",
        #     "version": "1.0.0",
        #     "license": "ISC",
        #     "path": "/aqua_modules/auth/initialise.php"
        # }
        file_contents["packages"][command] = data["config-lock"][command]
        file_contents = json.dumps(file_contents, indent=4)
        # print(file_contents)
        # Print the contents

    with open('config-lock.json', 'w') as f:
        f.write(file_contents)

    print(color_green+"\npackage installed")

def install(command):
    print(color_blue+"preparing to install... \n")
    url = 'https://aqua-php-package-service.vercel.app/api'

    commands = command.split()

    payload = {
        'name': commands[1],
    }

    json_payload = json.dumps(payload)

    headers = {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer YOUR_API_TOKEN'
    }

    # response = requests.get(url)
    response = requests.post(url, data=json_payload, headers=headers)

    # Check if the request was successful (status code 200)
    if response.status_code == 200:
        data = response.json()  # Parse JSON response into a Python dictionary or list
        time.sleep(1)
        print(color_blue+"package found...\n")
        set_package(data, commands[1])
        # print(data)
        # print(data["name"])
    else:
        data = response.json()
        # print('Error:', response.status_code)
        print(color_red+data["message"])

    

#     _                     _____  _   _ _____
#    / \   __ _ _   _     _|  __ \| | | |  __ \
#   / _ \ / _` | | | |/ _` | |__| | |_| | |__| |
#  / ___ \ (_| | |_| | (_| |  ___/|  _  |  ___/
# /_/   \_\__,_|_____|\__,_| |    | | | | |
#            |_|           |_|    |_| |_|_|

print(color_green+'''
    _                     _____  _   _ _____
   / \\   __ _ _   _     _|  __ \| | | |  __ \\
'''+'''  / _ \\ / _` | | | |/ _` | |__| | |_| | |__| |'''+ color_purple+'''
 / ___ \\ (_| | |_| | (_| |  ___/|  _  |  ___/
/_/   \\_\\__,_|\\___/ \\__,_| |    | | | | |
           |_|           |_|    |_| |_|_|
''')

print(color_blue+"1. Initialise use \"init\"")
print("2. Install use \"install 'package_name'\" ")

while True:
    command = input(color_purple+"\n>>> "+color_reset) 

    if command == "init":
        # init()
        pass
    elif command.startswith("install"):
        install(command)
    elif command.startswith("uninstall"):
        print("uninstall started")
    elif command == "exit":
        break
    else:
        print(color_red+"\""+command+"\""+" <- This Command Not Found")
