import os
import subprocess
import time
import json
import requests
import shutil
import colorama
from colorama import Fore, Style

# # ANSI escape codes for text colors
# Fore.RED = '\033[91m'
# Fore.GREEN = '\033[92m'
# Fore.YELLOW = '\033[93m'
# Fore.BLUE = '\033[94m'
# Fore.MAGENTA = '\033[95m'
# Fore.RESET = '\033[0m'  # Reset text color to default
repo_url = "https://github.com/Soubhik2/CORE-PHP.git"

def is_safe_path(target_path):
    base_path = os.path.abspath("aqua_modules/package")
    target_path = os.path.abspath(target_path)

    return target_path.startswith(base_path)

def init():
    # output = subprocess.run(["rmdir","/s","/q",name+"\\.git"], shell=True, capture_output=True, text=True)
    # if not output.returncode == 0:
    #     print(output.stderr)

    current_directory = os.getcwd()
    arr = current_directory.split("\\")

    path = '/'.join(arr[arr.index("htdocs")+1:])
    # path += '/'+name

    # Open the file for reading
    with open('index.php', 'r') as file:
        # Read the entire contents of the file
        file_contents = file.read()
        # Print the contents

    with open('index.php', 'w') as f:
        f.write(file_contents.replace("AquaPHP", path))

    with open('.htaccess', 'r') as file:
        # Read the entire contents of the file
        file_contents_h = file.read()
        # Print the contents

    with open('.htaccess', 'w') as f:
        f.write(file_contents_h.replace("AquaPHP", path))

    print(Fore.GREEN+"\nProject Initiated"+Fore.RESET)

def download_package(package):
    # print(package)
    print(Fore.BLUE+"downloading packages...\n")
    if is_safe_path(package['path']):
        process = subprocess.Popen(["git", "clone", package["url"], package['path']], stdout=subprocess.PIPE, stderr=subprocess.PIPE, text=True)
        while True:
            line = process.stdout.readline()
            if not line:
                break
            print(line.strip())
            line = process.stderr.readline()
            if not line:
                break
            print(line.strip())

        process.wait()

        if process.returncode == 0:
            path = f"{package['path']}/.git"
            # Windows uses 'rmdir', Linux/macOS uses 'rm'
            command = f'rmdir /s /q "{path}"' if os.name == "nt" else f'rm -rf "{path}"'

            if is_safe_path(path):
                # Run the delete command
                output = subprocess.run(command, shell=True, capture_output=True, text=True)

                # Check if deletion was successful
                if not os.path.exists(path):
                    print(Fore.GREEN+"package downloaded successful\n"+Fore.RESET)
                    return True
                else:
                    print(f"Deletion failed: {path} still exists.")
                    # Print command output (for debugging)
                    print("STDOUT:", output.stdout)
                    print("STDERR:", output.stderr)
                    return False
            else:
                print(Fore.RED+"package download failed\n"+Fore.RESET)
                return False

            # output = subprocess.run(["rm","-rf",package["path"]+"/",".git"], shell=True, capture_output=True, text=True)
            # output = subprocess.run(["Remove-Item","-Recurse","-Force",package["path"]+"\\",".git"], shell=True, capture_output=True, text=True)
            # print(output)
        else:
            print(Fore.RED+"package download failed\n"+Fore.RESET)
            return False
    else:
        print(Fore.RED+"package download failed\n"+Fore.RESET)
        return False

def set_package(data, command):
    if not os.path.exists(data["package"]["path"]):
        if download_package(data["package"]):
            print(Fore.BLUE+"installing packages...\n")
            
            # print(data["package"])
            
            time.sleep(3)

            # print(Fore.MAGENTA+"Install Starting..."+Fore.RESET)
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

            print(Fore.GREEN+"Package Installed !!!")
        else:
            print(Fore.RED+"Package Install Failed !!!")
    else:
        print(Fore.YELLOW+"Package Already Downloaded !!!")

def install(command):
    print(Fore.BLUE+"preparing to install... \n")
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
        print(Fore.BLUE+"package found...\n")
        set_package(data, commands[1])
        # print(data)
        # print(data["name"])
    else:
        data = response.json()
        # print('Error:', response.status_code)
        print(Fore.RED+data["message"])

def uninstall(command):
    print(Fore.BLUE+"preparing to uninstall... \n")
    time.sleep(5)
    commands = command.split()
    path_to_remove = 'aqua_modules/package/'+commands[1]
    # Check if the path exists
    if os.path.exists(path_to_remove):
        try:
            # Attempt to remove the directory
            if is_safe_path(path_to_remove):
                shutil.rmtree(path_to_remove)
                
                time.sleep(1)
                if not os.path.exists(path_to_remove):
                    with open('config.json', 'r') as file:
                        # Read the entire contents of the file
                        file_contents = file.read()
                        file_contents = json.loads(file_contents)
                        # file_contents["dependencies"][command] = {
                        #     "enable": False,
                        #     "path": "auth"
                        # }
                        # print(file_contents)
                        del file_contents["dependencies"][commands[1]]
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
                            del file_contents["packages"][commands[1]]
                            file_contents = json.dumps(file_contents, indent=4)
                            # print(file_contents)
                            # Print the contents

                    with open('config-lock.json', 'w') as f:
                        f.write(file_contents)
                    
                    # print(f"Successfully removed: {path_to_remove}")
                    print(Fore.GREEN+f"Successfully uninstall {commands[1]}")
            else:
                print(Fore.RED+f"Error removing {path_to_remove}: {e}")

        except Exception as e:
            # Handle any exceptions that occur
            print(Fore.RED+f"Error removing {path_to_remove}: {e}")
    else:
        print(Fore.RED+f"Package does not exist : {commands[1]}")

#     _                     _____  _   _ _____
#    / \   __ _ _   _     _|  __ \| | | |  __ \
#   / _ \ / _` | | | |/ _` | |__| | |_| | |__| |
#  / ___ \ (_| | |_| | (_| |  ___/|  _  |  ___/
# /_/   \_\__,_|_____|\__,_| |    | | | | |
#            |_|           |_|    |_| |_|_|

# print(Fore.GREEN+'''
#     _                     _____  _   _ _____
#    / \\   __ _ _   _     _|  __ \| | | |  __ \\
# '''+'''  / _ \\ / _` | | | |/ _` | |__| | |_| | |__| |'''+ Fore.MAGENTA+'''
#  / ___ \\ (_| | |_| | (_| |  ___/|  _  |  ___/
# /_/   \\_\\__,_|\\___/ \\__,_| |    | | | | |
#            |_|           |_|    |_| |_|_|
# ''')

print(Fore.GREEN+r'''
    _                     _____  _   _ _____
   / \   __ _ _   _     _|  __ \| | | |  __ \
'''+r'''  / _ \ / _` | | | |/ _` | |__| | |_| | |__| |'''+ Fore.MAGENTA+r'''
 / ___ \ (_| | |_| | (_| |  ___/|  _  |  ___/
/_/   \_\__,_|\___/ \__,_| |    | | | | |
           |_|           |_|    |_| |_|_|
''')

print(Fore.BLUE+"1. Initialise use \"init\"")
print("2. Install use \"install 'package_name'\" ")

while True:
    command = input(Fore.MAGENTA+"\n>>> "+Fore.RESET) 

    if command == "init":
        init()
        pass
    elif command.startswith("install"):
        install(command)
    elif command.startswith("uninstall"):
        uninstall(command)
    elif command == "exit":
        break
    else:
        print(Fore.RED+"\""+command+"\""+" <- This Command Not Found")
