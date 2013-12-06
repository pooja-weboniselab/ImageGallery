<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.html5uploader.min.js"></script>
<script type="text/javascript">
$(function() {
	$("#dropbox, #multiple").html5Uploader({
		name: "foo",
		postUrl: "drag.php"	
	});
});
</script>
<div id="dropbox"></div>
<input id="multiple" type="file" multiple>
                
