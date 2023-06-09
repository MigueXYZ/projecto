from importlib.metadata import files
import cv2
import sys
import time
import requests

url= "http://10.79.12.175/projeto/upload.php"
def tirarFoto():
    camera = cv2.VideoCapture(0, cv2.CAP_DSHOW) # captura a imagem usando a camara
    ret, image = camera.read()
    print ("Resultado da Camera=" + str(ret)) #printa o resultado
    cv2.imwrite('opencv_image.png', image) #escreve a imagem
    camera.release() #solta a camara
    cv2.destroyAllWindows() #destroi todas as janelas
    return
def sendFile():
    import datetime
    x = datetime.datetime.now()
    ola ='../Camara/'+str(x.strftime("%Y_%m_%d-%H_%M_%S"))+'.png' #nome da imagem com data
    r = requests.post(url, files={'imagem': (ola, open('opencv_image.png', 'rb') , 'image/jpeg')}) #
    if r.status_code != 200:
        print("ocorreu um erro")
        print(r.status_code)
    else:
        print("POST com sucesso")
    return
try:
    i=True
    valor_dif = 0
    while i:
        parametros={"nome":"Veiculos"}
        parametros2 = {"nome": "Fotos"}
        r = requests.get("http://10.79.12.175/projeto/api/api.php?nome=Veiculos") #vai buscar os ficheiros a api
        valor = r.text.strip()        
        time.sleep(2)
        print(valor)
        if (float(valor)!=float(valor_dif)): #só tira a foto se os valores forem diferentes
            valor_dif = valor
            print("Porta: "+valor)
            tirarFoto() # tira a foto
            cv2.imread('opencv_image.png', 0) #carrega a imagem de um ficheiro especifico e o devolve para a variavel img
            cv2.destroyAllWindows() #destroi todas as janelas
            sendFile() # manda a imagem
        time.sleep(5)
except KeyboardInterrupt: # caso haja interrupção de teclado CTRL+C
    print( "Programa terminado pelo utilizador")

except : # caso haja um erro qualquer

    print( "Ocorreu um erro:", sys.exc_info() )

finally : # executa sempre, independentemente se ocorreu exception
    print( "Fim do programa")