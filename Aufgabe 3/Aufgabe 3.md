# Aufgabe 3: Galerie Backend mit EC2 und PHP


## 1) Schlüsselpaar erstellen

EC2 -> Schlüsselpaare
- Name: aws-kurs
- Erstellen
- Abspeichern als `aws-kurs.pem`

Cloud9
- Schlüsselpaar auf Cloud9 hochladen
- In Cloud9 neues Terminal erstellen (Ctrl-T)
- Schlüsselpaar sichern (`chmod 600 aws-kurs.pem` im Terminal)


## 2) EFS Speicher erstellen

Neue Sicherheitsgruppe erstellen (EC2 -> Sicherheit)
- Name: "nfs"
- Beschreibung: "NFS Zugriff"
- Eingehende Regeln:
  - Typ: NFS, Quelle: IPv4 (0.0.0.0/0)
  - Typ: NFS, Quelle: IPv6 (::/0)

EFS -> Dateisystem erstellen
- Name: aws-kurs-code
- "anpassen" und "weiter"
- Bei "Netzwerkzugriff" 3 mal die Sicherheitsgruppe "nfs" hinzufügen
- "weiter", "weiter", "erstellen"
- Warten bis bereit
- In den Details auf "anfügen" klicken und 2. Befehl (NFS) kopieren

Cloud9
- Verzeichnis "efs" erstellen
- Im Terminal kopierten Befehl eingeben
- `sudo chmod 777 efs` im Terminal eingeben


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
