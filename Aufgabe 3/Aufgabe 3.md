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


## 5) EC2 Instanz erstellen

1. Service "EC2" öffnen

![image](_img/ec2-1.png)

2. "Instances" im linken Menü wählen

![image](_img/ec2-2.png)

3. "Instances starten" anklicken

![image](_img/ec2-3.png)

4. Im Schritt 1 "Amazon Linux 2" wählen

![image](_img/ec2-4.png)

5. In Schritt 2 "t2.micro" asl Instanztyp wählen

![image](_img/ec2-5.png)

6. Das EFS Volume `aws-kurs-code` als Speicher hinzufügen. **Pfad auf `/var/www/html` ändern**

![image](_img/ec2-6.png)

![image](_img/ec2-7.png)

7. Namens-Tag `aws-kurs-backend` hinzufügen

![image](_img/ec2-8.png)

![image](_img/ec2-9.png)

8. Eine neue Sicherheitsgruppe anlegen (Name: `aws-kurs-backend`, Beschreibung: `AWS Kurs Backend`) und als neue Regel HTTP erlauben

![image](_img/ec2-10.png)

![image](_img/ec2-11.png)

9. Instanz starten

![image](_img/ec2-12.png)

![image](_img/ec2-13.png)

10. Schlüsselpaar `aws-kurs` auswählen und bestätigen

![image](_img/ec2-14.png)


## 6) Webserver einrichten

1. Warten bis Instanz "Läuft". Danach auf "verbinden" klicken.

![image](_img/ec2-setup-1.png)

2. Reiter "SSH Client" öffnen und unteren Beispielbefehl kopieren.

![image](_img/ec2-setup-2.png)

3. In Cloud9 im Terminal den kopierten Befehl eingeben ([ENTER] drücken). Nachfrage mit "yes" und [ENTER] bestätigen.

![image](_img/ec2-setup-3.png)

4. In der SSH Verbindung die folgenden 3 Befehle eingeben und jeweils mit [ENTER] bestätigen.

```
sudo yum install -y httpd php
sudo service httpd start
sudo chmod 777 /var/www/html/pictures
```

![image](_img/ec2-setup-4.png)

![image](_img/ec2-setup-5.png)

![image](_img/ec2-setup-6.png)

5. Den Inhalt von `Aufgabe 3/code` kopieren und nach `efs` kopieren (Achtung: zuerst `efs` markieren und dann Rechtsklick darauf zum Einfügen).

![image](_img/ec2-setup-7.png)

![image](_img/ec2-setup-8.png)


## 7) App im Browser öffnen

1. Öffentliche IP in EC2 kopieren

![image](_img/app-1.png)

2. Neuen Browsertab öffnen und "http://" und die kopierte IP eingeben

![image](_img/app-2.png)

In der App können nun Bilder hochgeladen (nur .jpeg) und angesehen werden.

![image](_img/app-3.png)
