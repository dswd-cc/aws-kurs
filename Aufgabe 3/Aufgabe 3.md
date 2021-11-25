# Aufgabe 3: Galerie Backend mit EC2 und PHP


## 1) Schlüsselpaar erstellen und in Cloud9 einbinden

1. Service "EC2" öffnen

![image](_img/ec2-key-1.png)

2. Links "Schlüsselpaare" auswählen

![image](_img/ec2-key-2.png)

3. Schlüsselpaar erstellen

![image](_img/ec2-key-3.png)

4. Name (`aws-kurs`) und Format (PEM) eintragen

![image](_img/ec2-key-4.png)

5. Schlüsselpaar als PEM-Datei speichern

6. Datei in Cloud9 in `environment` per Drag&Drop hochladen (Oberstes Verzeichnis)

![image](_img/ec2-key-5.png)

7. Terminal öffnen und `chmod 600 aws-kurs.pem` eingeben ([ENTER] drücken)

![image](_img/ec2-key-6.png)


## 2) Sicherheitsgruppe für NFS erstellen

1. Im EC2 Menü "Sicherheitsgruppen" wählen

![image](_img/efs-secgroup-1.png)

2. "Sicherheitsgruppe erstellen" wählen

![image](_img/efs-secgroup-2.png)

3. Name (`nfs`) und Beschreibung (`NFS Zugriff`) eintragen

![image](_img/efs-secgroup-3.png)

4. Regeln für **eingehenden** Datenverkehr eintragen
  - Typ: "NFS", Quelle: "Anywhere-IPv4"
  - Typ: "NFS", Quelle: "Anywhere-IPv6"

![image](_img/efs-secgroup-4.png)

5. Regel anlegen

![image](_img/efs-secgroup-5.png)


## 3) EFS Speicher erstellen

1. Service "EFS" öffnen

![image](_img/efs-1.png)

2. Neues Dateisystem erstellen

![image](_img/efs-2.png)

3. Name (`aws-kurs-code`) setzen

![image](_img/efs-3.png)

4. "Weiter klicken"

![image](_img/efs-4.png)

5. Für alle Availability Zones die Sicherheitsgruppe `nfs` hinzufügen. (**Achtung: Die Gruppe `default` muss bleiben**)

![image](_img/efs-5.png)

6. 2x "Weiter" klicken und dann "Erstellen" klicken

![image](_img/efs-6.png)

![image](_img/efs-7.png)

![image](_img/efs-8.png)


## 4) Dateisystem in Cloud9 einbinden

1. Dateisystem `aws-kurs-code` öffnen

![image](_img/efs-mount-1.png)

2. Reiter "Netzwerk" öffnen und warten bis Status = "Verfügbar"

![image](_img/efs-mount-2.png)

3. Auf "Anfügen" klicken

![image](_img/efs-mount-3.png)

4. Unteren Befehl kopieren

![image](_img/efs-mount-4.png)

5. In Cloud9: Neues Verzeichnis `efs` im Hauptverzeichnis erstellen

![image](_img/efs-mount-5.png)

6. Kopierten Befehl im Terminal eingeben

![image](_img/efs-mount-6.png)

7. Berechtigung setzen: `sudo chmod 777 efs` im Terminal eingeben ([ENTER] danach)

![image](_img/efs-mount-7.png)


## 3) EC2 Instanz erstellen

EC2 -> Instanzen -> Instanz starten

Schritt 1
- AMI: Amazon Linux 2

Schritt 2
- Instance-Typ: t2.micro

Schritt 3
- "aws-kurs-code" Dateisystem hinzufügen, Mountpunkt: /var/www/html

Schritt 4: weiter

Schritt 5:
- Labels: Name: aws-kurs-backend

Schritt 6:
- Name: aws-kurs-backend
- HTTP erlauben

Fertig, Starten
- Schlüsselpaar "aws-kurs" auswählen

Warten bis verfügbar
Private IP von EC2 Instanz kopieren


## 4) Webserver einrichten

In Cloud9:
- code nach efs rüberkopieren
- Neues Terminal öffnen (Ctrl-T)
- `ssh -i aws-kurs.pem PRIVATE-IP` ausführen, mit "yes" bestätigen

Im gleichen Terminal (SSH auf dem Backend)
- `sudo yum install -y httpd php`
- `sudo service httpd start`
- `sudo chmod 777 /var/www/html/pictures`

In EC2 die "öffentliche IP" des Backends kopieren

Im Browser:
- http://PUBLIC-IP/test.php aufrufen (Achtung: HTTP statt HTTPS)
