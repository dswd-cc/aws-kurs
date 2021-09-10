<!DOCTYPE html>
<?php 
require "config.php";

$result = $client->scan(['TableName' => $db_table])['Items'];
$pictures = [];
foreach ($result as $item) {
    $pictures[] = $marshaler->unmarshalItem($item);
}
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
        pictures: <?php echo json_encode($pictures) ?>, 
        current: null,
        upload: function() {
            let file = $refs.upload.files[0];
            let formData = new FormData();
            formData.append("upload", file);
            fetch("/upload.php", {method: "POST", body: formData}).then(response => {
                if (response.ok) response.json().then(name => this.pictures.push({file: name, rating: 0}));
            });
        }
    }'>
        <h1>Meine Fotos</h1>
	    <template x-for="pic, id in pictures">
	    	<img :src="'pictures/' + pic.file" class="thumbnail" :class="{selected: current == id}" @click="current = id"/>
	    </template>
	    <input type="file" accept=".jpeg" style="display: none" x-ref="upload" x-on:change="upload">
	    <button @click="$refs.upload.click();">
	        Upload <svg style="filter: invert(100%)" width="24" height="24" viewBox="0 0 24 24"><path d="M8 10h-5l9-10 9 10h-5v10h-8v-10zm11 9v3h-14v-3h-2v5h18v-5h-2z"/></svg>
	    </button>
	    <template x-if="current !== null">
	        <div x-data='{ 
	           pic: function() {
	               return pictures[current];
	           },
	           rate: function(r) {
                    this.pic().rating = r;              
	               fetch("/rate.php", {method: "POST", body: JSON.stringify(this.pic())});
	           }
	       }'>
    	        <center>
    	            <template x-for="i in [1, 2, 3, 4, 5]">
    	                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" :style="i <= pic().rating ? 'color: #fbbf24;' : 'color: #9ca3af;'" @click="rate(i)">
                            <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z"/>
                        </svg>
    	            </template>
    	        </center>
    	    	<img :src="'pictures/'+pic().file" />
	        </div>
	    </template>
    </body>
</html>