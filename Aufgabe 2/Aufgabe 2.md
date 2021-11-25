# Aufgabe 2: Galerie auf S3 hosten

## 1) Bucket in S3 erstellen

1. Service "S3" öffnen

![image](_img/s3-create-1.png)

2. Neuen Bucket erstellen

![image](_img/s3-create-2.png)

3. Bucketname eingeben. **‼️ Achtung: Der Bucketname muss weltweit eindeutig sein ‼️**

![image](_img/s3-create-3.png)

4. Öffentlichen Zugriff generell erlauben damit das Webhosting funktioniert

![image](_img/s3-create-4.png)

![image](_img/s3-create-5.png)

5. Bucket erstellen

![image](_img/s3-create-6.png)

6. Bucket in der Übersicht auswählen

![image](_img/s3-create-7.png)


## 2) Statisches Hosting aktivieren

1. Reiter "Eigenschaften" öffnen

![image](_img/s3-static-1.png)

2. Statisches Hosting aktivieren. Als Indexdokument `index.html` eintragen.

![image](_img/s3-static-2.png)

![image](_img/s3-static-3.png)

![image](_img/s3-static-4.png)


## 3) Bucketrichtlinie erstellen

1. Reiter Berechtigungen öffnen

![image](_img/s3-acl-1.png)

2. Bucketrichtlinie bearbeiten

![image](_img/s3-acl-2.png)

Folgenden Text eintragen:

```json
{
  "Version":"2012-10-17",
  "Statement":[
    {
      "Sid":"PublicRead",
      "Effect":"Allow",
      "Principal": "*",
      "Action":["s3:GetObject","s3:GetObjectVersion"],
      "Resource":["arn:aws:s3:::DOC-EXAMPLE-BUCKET/*"]
    }
  ]
}
```

**‼️ Achtung: Der Bucketname muss in das Feld Ressource anstelle von "DOC-EXAMPLE-BUCKET" eingetragen werden ‼️**

![image](_img/s3-acl-3.png)

3. Änderungen speichern

![image](_img/s3-acl-4.png)


## 4) Webseite hochladen

1. Reiter Objekte öffnen

![image](_img/s3-upload-1.png)

2. Auf "Hochladen" klicken

![image](_img/s3-upload-2.png)

3. Dateien aus dem Verzeichnis `Aufgabe 2/web` herunterladen und per Drag&Drop hochladen.

![image](_img/s3-upload-3.png)

4. "Hochladen" klicken

![image](_img/s3-upload-4.png)

5. Warten bis der Upload erfolgt ist


## 5) Webseite öffnen

1. Reiter "Eigenschaften" öffnen

![image](_img/s3-web-1.png)

2. URL unter "Statisches Hosting" im Browser öffnen

![image](_img/s3-web-2.png)

Nun sollte die App angezeigt werden.

![image](_img/app-1.png)

Nach einem Klick auf ein Thumbnail öffet sich das Bild in der Großansicht 

![image](_img/app-2.png)


## 5) Weitere Fotos einbinden (optional)

1. Weitere Fotos hochladen (z.B. von https://unsplash.com/)

2. Cloud9 öffnen

3. Index.html in Cloud9 öffnen

![image](_img/change-1.png)

4. Liste der Fotos anpassen (**Achtung: Groß/Kleinschreibung beachten**)

![image](_img/change-2.png)

5. Geänderte Index.html in S3 Bucket hochladen, z.B. so:

![image](_img/change-3.png)
