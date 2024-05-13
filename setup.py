import os
import subprocess
import time
import json

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

def install(command):
    print(color_purple+"Install Starting..."+color_reset)
    time.sleep(1)
    with open('config.json', 'r') as file:
        # Read the entire contents of the file
        file_contents = file.read()
        file_contents = json.loads(file_contents)
        file_contents["dependencies"][command] = {
            "enable": False,
            "path": "auth"
        }
        file_contents = json.dumps(file_contents, indent=4)
        # print(file_contents)
        # Print the contents

    with open('config.json', 'w') as f:
        f.write(file_contents)
    
    with open('config-lock.json', 'r') as file:
        # Read the entire contents of the file
        file_contents = file.read()
        file_contents = json.loads(file_contents)
        file_contents["packages"][command] = {
            "name": "core",
            "version": "1.0.0",
            "license": "ISC",
            "path": "/aqua_modules/auth/initialise.php"
        }
        file_contents = json.dumps(file_contents, indent=4)
        # print(file_contents)
        # Print the contents

    with open('config-lock.json', 'w') as f:
        f.write(file_contents)

print(color_yellow+"Install Package")

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
        print("command not found")
