import customtkinter
import serial.tools.list_ports
import tkinter as tk  # Import tkinter for the Text widget
import sys
import os
from datetime import date
from datetime import datetime 
import threading

# # The URL of the website you want to open
# default_website_url = 'http://127.0.0.1:8000'  # Replace with your desired website URL

# Define the COM port (adjust the port name accordingly)
default_com_port = 'COM4'

def find_prolific_port():
    for port in serial.tools.list_ports.comports():
        if "Prolific" in port.description:  # You can use other properties like "manufacturer" or "product" if necessary
            return port.device
    return None  # Return None if no Prolific port is found

def run():
    if(find_prolific_port() == None):
       new_com_port =  default_com_port 
    else:
        new_com_port = find_prolific_port()


    def read_serial():
        # Configure serial communication
        ser = serial.Serial(new_com_port, baudrate=9600, timeout=1)  # Adjust baudrate and timeout as needed
        
        print(f"Connected to port: {new_com_port}")
        # print(f'URL: {new_url}')
        
        print("\nWaiting for RFID...")

        try:
            while True:
                # Read data from the COM port
                data = ser.readline()  # Read a line of data
                
                # Process and print the data (replace this with your desired action)
                decoded_data = data.decode('utf-8').replace(" ", "").strip()
                                
                if(decoded_data):
                    formatted_timestamp = datetime.now().strftime("%m/%d/%Y - %I:%M:%S %p")
                    print(f"RFID: {decoded_data} -> {formatted_timestamp}")
                    # webbrowser.open(f'{new_url}/rfid-tags?livestock_id={decoded_data}')
        
        except KeyboardInterrupt:
            output_text.insert(tk.END, "Serial communication stopped by user\n")
        
        finally:
            ser.close()  # Close the COM port when done

    # Create a thread for the run function
    run_thread = threading.Thread(target=read_serial)
    run_thread.daemon = True  # Allow the thread to exit when the main program exits
    run_thread.start()

def save_log():
    log_text = output_text.get(1.0, tk.END)  # Get the text from the output_text widget

    # Define the path to the log folder within the Laravel project's "public" directory
    log_folder = os.path.join("logs")

    log_filename = f"log_{date.today()}.txt"  # Create a filename with the current date

    # Create the log folder if it doesn't exist
    if not os.path.exists(log_folder):
        os.makedirs(log_folder)

    log_filepath = os.path.join(log_folder, log_filename)  # Combine folder and filename


    # Check if the file exists
    if os.path.exists(log_filepath):
        # File already exists, append the text with a divider
        with open(log_filepath, "a") as log_file:  # Use "a" for append mode
            log_file.write("\n----------------------------------------\n")
            log_file.write(log_text)
    else:
        # File does not exist, create a new file
        with open(log_filepath, "w") as log_file:
            log_file.write(log_text)

    rfid_folder = os.path.join("rfid")

    rfid_filename = "log_rfid.txt"  # Create a filename with the current date

    # Create the log folder if it doesn't exist
    if not os.path.exists(rfid_folder):
        os.makedirs(rfid_folder)

    rfid_filepath = os.path.join(rfid_folder, rfid_filename)  # Combine folder and filename

    # File does not exist, create a new file
    with open(rfid_filepath, "w") as log_file:
        log_file.write(log_text)
        

    print(f"Log saved to {log_filepath}")





customtkinter.set_appearance_mode("dark")  # Modes: system (default), light, dark
customtkinter.set_default_color_theme("green")  # Themes: blue (default), dark-blue, green

app = customtkinter.CTk()  # create CTk window like you do with the Tk window
app.geometry("700x540")
app.title("RFID Reader")

frame = customtkinter.CTkFrame(master=app)
frame.pack(padx=20, pady=30, fill='both', expand=True)

label = customtkinter.CTkLabel(master=frame, text="RFID Reader", font=('Roboto', 42))
label.pack(padx=12, pady=16)


optionLabel = customtkinter.CTkLabel(frame, text="COM Port:", font=('Roboto', 16))
optionLabel.pack(padx=20)
optionmenu = customtkinter.CTkEntry(frame, placeholder_text=find_prolific_port(), width=540)
optionmenu.pack(padx=20, pady=12)

# inputLabel = customtkinter.CTkLabel(frame, text="Website URL:", font=('Roboto', 16))
# inputLabel.pack(padx=20)
# inputEntry = customtkinter.CTkEntry(frame, placeholder_text='http://example.com', width=540)
# inputEntry.pack(padx=20, pady=12)

# Add the "Run" button
run_button = customtkinter.CTkButton(frame, text="Run", command=run, font=('Roboto', 16))
run_button.pack(padx=10, pady=10)

# Create a frame for the print output with a darker background
output_frame = customtkinter.CTkFrame(master=frame)  # Use a dark background color
output_frame.pack(fill='both', expand=True)

# Create a Text widget to display the print output
output_text = customtkinter.CTkTextbox(output_frame, wrap=tk.WORD, font=('Courier', 12))
output_text.pack(pady=10, fill='both', expand=True)

# Redirect the print output to the Text widget
def redirect_output(text_widget):
    class PrintRedirector:
        def __init__(self, widget):
            self.widget = widget

        def write(self, text):
            self.widget.insert(tk.END, text)
            self.widget.see(tk.END)  # Scroll to the end

        def flush(self):
            pass

    sys.stdout = PrintRedirector(output_text)

def on_closing():
    save_log()
    # Add a one-second delay (1000 milliseconds) before exiting
    app.after(1000, app.destroy)

# Bind the on_closing function to the closing event of the application window
app.protocol("WM_DELETE_WINDOW", on_closing)

redirect_output(output_text)

app.mainloop()
