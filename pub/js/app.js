var current_view=function(){
    var local=window.location.href;
    var arr=local.split('/');
    var last=arr.pop();
    if (last=="") {
        return 'home';
    }
    return last;
}
//
// functions
//
var show_mesg=function(str){
	$('.message').html('<p>'+str+'</p>');
	setTimeout(function(){$('.message p').hide();},5000);
};
var show_msg_trans=function(str){
	$('.loading').css('visibility','visible');
	$('.loading').html('<h2>'+str+'</h2>');
	setTimeout(function(){$('.loading').css('visibility','hidden');},5000);

};

var loading_trans=function(){
	$('.loading').css('visibility','visible');
	setTimeout(function(){$('.loading').css('visibility','hidden');},1500);
};
//place page numbers in 
var loadPagination=function(page){
    var npages=Cookies.get('npages');
    var listHTML="";
    for(i=1;i<=npages;i++){
        if (i!=page){
            listHTML+="<li><a href='#'>"+i+"</a></li>";
        }
        else{
            listHTML+="<li><a href='#'><span class='currentp'>"+i+"</span></a></li>";
        }
    }
    $('ul.pagination').html(listHTML);
}

// load adverts in view home
	
var loadAdvert=function(data){
    $('.users-table').hide();
	$.each(data, function(index, element) {
			console.log(data);
            if (element.foto1!="foto1"){
                $('.adverts-table').append('<div class="advert"><p>'
                	+element.description+' '+element.idAdvertises.toString()
                	+'<img width="100px" src="'+element.foto1+'"/>'+
                	'</p></div>');
            }else{
                $('.adverts-table').append('<div class="advert"><p>'
                    +element.description+' '+element.idAdvertises.toString()
                    +
                    '</p></div>');
        }
	});
};            

var users_table=function(resp){
	console.log(resp);
    $('.adverts-table').hide();
    var listHTML="<table><tr><th>Id</th><th>Nom</th><th>Email</th><th>Password</th><th>Rol</th></tr>";
        for (var key in resp){
                listHTML += "<tr>";
                listHTML += "<td>" + resp[key]["id"] + "</td>";
                listHTML += "<td><input type='text' size=20 id='username"+resp[key]["id"]+"' value=" + resp[key]["username"] + "></td>";
                listHTML += "<td><input type='email' size=40 id='email"+resp[key]["id"]+"' value=" + resp[key]["email"] + "></td>";
                    listHTML += "<td><input type='password' size=30 id='passw"+resp[key]["id"]+"' value=" + resp[key]["passw"] + "></td>";
                    listHTML += "<td><input type='number' size=4 id='rol"+resp[key]["id"]+"' value=" + resp[key]["rol"] + "></td>";
                    listHTML += "<td><button class='bedit' id='bed"+resp[key]["id"]+"'><button class='btrash' id='btr"+resp[key]["id"]+"'></td>"
                    listHTML += "</tr>";

        }
    

	
	listHTML += "<tr>";
	listHTML += "<td></td>";
	listHTML += "<td><input type='text' size=20 id='usernameafe' value=''></td>";
	listHTML += "<td><input type='email' size=40 id='emailafe' value=''></td>";
	listHTML += "<td><input type='password' size=30 id='passwafe' value=''></td>";
				listHTML += "<td><input type='number' size=4 id='rolafe' value=''></td>";
	listHTML += "<td><button id='bafeg'>+</button></td></tr>";
	 listHTML+="</table>";
     $('h2').text('Usuaris');
    
	$('.users-table').append(listHTML);



};

$(document).ready(function(){
    var view=current_view();
    
    console.log( "ready!" );
    $('ul.pagination').on('click','li a',function(){
      
    	var strid=$(this).text();
    	var id=parseInt(strid);
    	var bURL=window.location.pathname;
    	// var dataString="id="+id;
    	//var fURL=$(this).attr('href');
    	//window.location.href=fURL;
    	var fURL='home/getPage';
    	$.ajax({
    		url:fURL,
    		method:'post',
    		data:{'p':id},
    		dataType:'json',
    		success:function(dades){
    	 		console.log(dades);
    	 		$('.container').html('');
    	 		    loadPagination(id);
					loadAdvert(dades);
    	 	}
    	 });

    	//return false;
    });
     // listUsers
      $('.navbar-inverse ul a li').eq(1).on('click',function(){
          //alert('usuaris');
          //$(this).attr('href','#');
          $.ajax({
            url:'dashboard/users',
            dataType:'json',
            success:function(dades){
                users_table(dades);
            }
            });
      });

    //hide pagination bar
     if(view=='register'){
         $('ul.pagination').html('');
     }
    	
    //initial load
    var page=Cookies.get('page');
    if (page==undefined) {
        page=1;
    };

    $.ajax({
    	url:'home/getPage',
        method:'post',
        data:{'p':page},
    	dataType:'json',
    	success:function(dades){
    		$('.container').html('');
                    loadPagination(page);
                    loadAdvert(dades);
    	}
    	
     	});
    
    //login
    $('.form-log').on('submit',function(){
    	console.log('click');
    	var postData=$(this).serialize();
        var formURL = $(this).attr("action");
		$.ajax({
			url:formURL,
			data:postData,
			method:'post',
			dataType:'json',
			beforeSend: function(){
				loading_trans();
			},
			error: function(){
				show_mesg('Error inici de sessió');
			},
			success:function(resp){
				console.log(resp);
                window.location.href=resp.redir;
                
			}
		});
		return false;
	});
	//
	// Comprovació de passwords
	//
	$('#repass').focusout(function(){
		var pass=$('#pass').val();
		var repass=$('#repass').val();
		if (pass!==repass){
			show_mesg('Passwords must be equals!');
		}
	});

    // 
    // Registre
    //
    $('.form-reg').on('submit',function(){
    	var postData=$(this).serialize();
    	var formURL=$(this).attr('action');
    	$.ajax({
    		url:formURL,
    		data:postData,
    		type:'post',
    		dataType:'json',
    		beforeSend:function(){
    			show_mesg('Registering...')
    		},
    		success:function(resp){
    			console.log(resp);
                window.location.href=resp.redir;
			},
    		error:function(){
    			show_mesg('Error registering');
    		}
    		});
    	return false;
    	
    	//final registre
    });


}); // document ready
