# Aufgabe 1: Galerie auf S3 hosten


## 1) S3 -> Bucket erstellen
- Eindeutiger Name

## 2) "Hosten einer statischen Website" (Eigenschaften) aktivieren 
- Indexdokument: "index.html"

## 3) Berechtigungen
- "Öffentlichen Zugriff beschränken" ausschalten
- Bucket-Rrichtlinie eintragen. Resource anpassen!

```
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

## 4) Fotos hochladen

## 5) Index.html anpassen und hochladen

Fotos z.B. von https://unsplash.com/

## 6) Galerie öffnen
- Link im S3 Bucket unten bei "statische Website"