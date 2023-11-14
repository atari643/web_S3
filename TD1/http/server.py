import socket
import socketserver
import datetime


class WebServer(socketserver.BaseRequestHandler):
    def parse_params(self,page):
        params_dict = {}
        if "?" in page:
            params = page.split("?")[1]
            for param in params.split("&"):
                key, value = param.split("=")
                params_dict[key] = value
        return params_dict

    def handle_get_request(self,page, params_dict):
        addition = 0
        if ".jpeg" not in page:
            try:
                num1 = int(params_dict.get('n1', 0)) 
                num2 = int(params_dict.get('n2', 0)) 
                addition = num1 + num2
            except:
                print("Error")
        return addition

    def handle_post_request(self,io, content_length, params_dict):
        body = io.read(content_length)
        form_data = body.split('&')
        for field in form_data:
            key, value = field.split('=')
            params_dict[key] = value
        addition = 0
        try:
            num1 = int(params_dict.get('n1', 0)) 
            num2 = int(params_dict.get('n2', 0)) 
            addition = num1 + num2
        except:
            print("Error")
        return addition

    def handle(self):
        client = self.request
        io = client.makefile()

        print('> Request: ')
        receivingHeaders = True
        page=""
        addition=0
        content_length = 0
        post=False
        params_dict = {} 
        while receivingHeaders:
            line = io.readline().strip()
            print(line)
            if(line.split(" ")[0]=="GET"):
                post=False
                page=line.split(" ")[1]
                params_dict = self.parse_params(page)
                addition = self.handle_get_request(page, params_dict)
            if(line.split(" ")[0]=="POST"):
                post=True
            if("Content-Length:" in line and post):
                content_length = int(line.split("Content-Length: ")[1])
            if line == '':
                receivingHeaders = False
        if(post):
            addition = self.handle_post_request(io, content_length, params_dict)
        img = None
        if "jpeg" in page:
            img = open('images.jpeg', 'rb')
            data = img.read()
            img.close()

        print('> Response: ')
        response = ""
        if(".jpeg" in page):
            response = b"HTTP "+page.encode('utf-8')+b" 1.1 200 OK\r\n"
        else:
            response = "HTTP "+page+" 1.1 200 OK\r\n"
        if ".jpeg" in page:
            response += b"Content-type: image/jpeg\r\n"
        elif ".css" in page:
            response += "Content-type: text/css\r\n"
        elif ".js" in page:
            response += "Content-type: application/javascript\r\n"
        elif ".html" in page:
            response += "Content-type: text/html\r\n"
        if(".jpeg" in page):
            response += b"\r\n"
        else:
            response += "\r\n"
        if ".jpeg" in page:
            response += data
        else:
            with open("index.html", "r") as f:
                response += f.read()
                response += "\r\n"
                response += "<p>La somme est : "+str(addition)+"</p>"            
        print(response)
        if(".jpeg" in page):
            client.sendall(response)
        else:
            client.sendall(response.encode('utf-8'))

HOST, PORT = "127.0.0.1", 8080
socketserver.TCPServer.allow_reuse_address = True
with socketserver.TCPServer((HOST, PORT), WebServer) as server:
    server.serve_forever()
