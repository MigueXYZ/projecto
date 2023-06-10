import random
import requests
import time
import datetime
import RPi.GPIO as GPIO

img_counter = 0

GPIO.setmode(GPIO.BCM)
channel=2
GPIO.setup(channel, GPIO.OUT)


print("--- Prima CTRL + C para terminar ---")
ip = "10.79.12.175"

def post2API(nome,valor):
    agora = datetime.datetime.now()
    print(agora.strftime("%y-%m-%d %H:%M:%S"))
    payload={'nome':nome,'valor':valor,'hora':agora.strftime("%y-%m-%d %H:%M:%S")}
    print(payload)
    requests.post('http://'+ip+'/projeto/api/api.php', data=payload)

try:


    while True:

        now = datetime.datetime.now()
        params={"nome":"Luzes"}
        i=requests.get("http://"+ip+"/projeto/api/api.php",params)
        i=i.text
        print("Luzes1" + i.text)
        channel=2
        GPIO.setup(channel, GPIO.OUT)
        if float(i) == 1:
            post2API("Luzes",1)
            GPIO.output(channel,GPIO.HIGH)
        elif float(i) == 0:
            post2API("Luzes",0)
            GPIO.output(channel,GPIO.LOW)
        params={"nome":"Luzes2"}
        i=requests.get("http://"+ip+"/projeto/api/api.php",params)
        i=i.text
        print("Luzes2" + i.text)
        channel=3
        GPIO.setup(channel, GPIO.OUT)
        if float(i) == 1:
            post2API("Luzes2",1)
            GPIO.output(channel,GPIO.HIGH)
        elif float(i) == 0:
            post2API("Luzes2",0)
            GPIO.output(channel,GPIO.LOW)
        params={"nome":"Luzes3"}
        i=requests.get("http://"+ip+"/projeto/api/api.php",params)
        i=i.text
        print("Luzes3" + i.text)
        if float(i) == 1:
            post2API("Luzes3",1)
            GPIO.output(channel,GPIO.HIGH)
        elif float(i) == 0:
            post2API("Luzes3",0)
            GPIO.output(channel,GPIO.LOW)
        r = requests.get("http://10.79.12.175/projeto/api/api.php?nome=CancelaA") #vai buscar os ficheiros a api
        cancelaA = r.text.strip()

        r = requests.get("http://10.79.12.175/projeto/api/api.php?nome=CancelaB") #vai buscar os ficheiros a api
        cancelaB = r.text.strip()
        channel=5
        GPIO.setup(channel, GPIO.OUT)
        if float(i) == 1:
            post2API("CancelaA",1)
            GPIO.output(channel,GPIO.HIGH)
        elif float(i) == 0:
            post2API("CancelaA",0)
            GPIO.output(channel,GPIO.LOW)

        channel=6
        GPIO.setup(channel, GPIO.OUT)
        if float(i) == 1:
            post2API("CancelaB",1)
            GPIO.output(channel,GPIO.HIGH)
        elif float(i) == 0:
            post2API("CancelaB",0)
            GPIO.output(channel,GPIO.LOW)


        time.sleep(20)


except KeyboardInterrupt:
    print("\nA execução do programa foi interrompida pelo usuário.")
    GPIO.cleanup()

except Exception as e:
    GPIO.cleanup()
    print("Erro inesperado:", e)
    print("Tenta outra vez")

