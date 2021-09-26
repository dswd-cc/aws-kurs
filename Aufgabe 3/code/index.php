<!DOCTYPE html>
<?php 
$pictures_path = "pictures";
$files = array_values(array_diff(scandir($pictures_path), array('.', '..')));
?>
<html>
    <head>
        <link rel="stylesheet" href="https://unpkg.com/bamboo.css">
        <script src="https://unpkg.com/alpinejs" defer></script>
        <style>
            img {
                margin: 2mm;
                border-radius: 1mm;
            }
            .thumbnail {
                border: 2px solid grey;
                width: 8em;
                height: 12em;
                object-fit: cover;
            }
            .selected {
                border-color: blue;
            }
        </style>
    </head>
    <body x-data='{ 
        pictures: <?php echo json_encode($files) ?>, 
        current: null,
        upload: function() {
            let file = $refs.upload.files[0];
            let formData = new FormData();
            formData.append("upload", file);
            fetch("/upload.php", {method: "POST", body: formData}).then(response => {
                if (response.ok) response.json().then(name => this.pictures.push(name));
            });
        }
    }'>
        <h1>Meine Fotos</h1>
	    <template x-for="pic in pictures">
	    	<img :src="'pictures/' + pic" class="thumbnail" :class="{selected: current == pic}" @click="current = pic"/>
	    </template>
	    <input type="file" accept=".jpeg" style="display: none" x-ref="upload" x-on:change="upload">
	    <button @click="$refs.upload.click();">
	        Upload <svg style="filter: invert(100%)" width="24" height="24" viewBox="0 0 24 24"><path d="M8 10h-5l9-10 9 10h-5v10h-8v-10zm11 9v3h-14v-3h-2v5h18v-5h-2z"/></svg>
	    </button>
	    <template x-if="current">
	    	<img :src="'pictures/'+current" />
	    </template>
    </body>
</html>