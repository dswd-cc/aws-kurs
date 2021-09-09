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
            }
            .selected {
                border-color: blue;
            }
        </style>
    </head>
    <body x-data='{ 
    pictures: <?php echo json_encode($files) ?>, 
    current: null 
    }'>
        <h1>Meine Fotos</h1>
	    <template x-for="pic in pictures">
	    	<img width=100 :src="'pictures/' + pic" class="thumbnail" :class="{selected: current == pic}" @click="current = pic"/>
	    </template>
	    <div x-show="current">
	    	<img :src="'pictures/'+current" />
	    </div>
    </body>
</html>