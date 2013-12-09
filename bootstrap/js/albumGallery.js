





function coverAlbum(id){
    //alert(id);

    //alert("triggered!");

    //alert('checked');
    var imageID= id;
    //alert(imageID);
    var AlbumId = $("div.span3").attr('id');
    $.ajax({
        type: "POST",
        url:"coverimage.php?imageID="+imageID+"&&albumID="+AlbumId, // file where you process the list.

        success:function(data){
            if(data>0){
                alert("album cover is set");
                location.reload() ;
            }

        }

    });


}