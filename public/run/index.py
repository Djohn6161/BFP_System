import subprocess
import os
import time

def run_xampp():
    # Path to the XAMPP control executable
    xampp_path = "C:\\xampp\\xampp_start.exe"
    
    # Start Apache and MySQL services
    subprocess.run(xampp_path, shell=True)

def run_php_artisan():
    # Change directory to where your Laravel project resides
    os.chdir("D:\\WORKS\\BFP\\BFP_System")
    subprocess.run(["php", "artisan", "serve", "--host", "0.0.0.0"], shell=True)

if __name__ == "__main__":
    run_xampp()
    # Wait a few seconds to ensure XAMPP services are up and running
    time.sleep(10)
    run_php_artisan()
