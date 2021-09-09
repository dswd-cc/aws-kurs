# Aufgabe 2: Galerie Backend mit EC2 und PHP

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
- AMI: Amazon Linux 2
- Instance-Typ: t2.micro (Schritt 2)
- "aws-kurs-code" Dateisystem hinzufügen, Mountpunkt: /var/www/html (Schritt 3)
- Labels: Name: aws-kurs-backend (Schritt 5)
- HTTP und HTTPS erlauben (Schritt 6)
- Fertig, Starten
- Schlüsselpaar "aws-kurs" auswählen
- Warten bis verfügbar
- Private IP von EC2 Instanz kopieren

In Cloud9
- Neues Terminal öffnen (Ctrl-T)
- `ssh -i aws-kurs.pem PRIVATE-IP` ausführen, mit "yes" bestätigen


## 4) Webserver einrichten
Im Backend Cloud9 Terminal:
- `sudo yum install -y httpd php`
- `sudo service httpd start`

In EC2 die "öffentliche IP" des Backends kopieren

In Cloud9:
- test.php nach efs rüberkopieren

Im Browser:
- http://PUBLIC-IP/test.php aufrufen
