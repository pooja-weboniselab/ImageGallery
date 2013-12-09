
function createAlbum()
{
    var newAlbum;

    var album=prompt("Album name","");

    if (album!=null)
    {
        newAlbum= album;
        insertAlbum(newAlbum);


    }
}



function insertAlbum(str){

    $.ajax({
        type: "POST",
        url:"newalbum.php?album="+str, // file where you process the list.
        success:function(data){
            console.log(data);
            $("#albumgallery").append(data) ;

        }

    });

}
function deleteAlbum(id){
    //alert(id);
    //alert($("#albumgallery").children('li').attr('id'));
    $.ajax({
        type: "POST",
        url:"deletealbum.php?album="+id, // file where you process the list.
        success:function(data){
            // alert(data)
            if(data==1){
                location.reload();
            }


        }

    });

}
