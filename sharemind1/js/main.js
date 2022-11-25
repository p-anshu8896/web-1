function loginvld(){
	var eml1=document.getElementById("email1").value;
	eml1=eml1.trim();
	if( eml1=="" ){
		alert("Plz Enter Email");
		return false;
	}
	var ps=document.getElementById("pswd").value;
			ps=ps.trim();
		if(ps==""){
			alert("plz enter password");
			document.getElementById("pswd").focus();
			document.getElementById("pswd").value="";
			return false;
		}

}


  
function regvld(){
		var nm=document.getElementById("unm").value;
		if(nm==""){
			alert("Enter your name");
			document.getElementById("unm").focus();
			return false;
		}
		if(nm.length<3){
			alert("Enter atleast 3 character");
			document.getElementById("unm").focus();
			return false;
	}
		
		var eml=document.getElementById("eml").value;
		eml=eml.trim();
		if(eml==""){
			alert("Enter Email Address");
			document.getElementById("eml").focus();
			document.getElementById("eml").value="";
			return false;
		}else{
		 var atpos=eml.indexOf("@");
		 var dotpos=eml.lastIndexOf(".");
		 if(atpos<1 || dotpos<atpos+2 || dotpos+2>=eml.length){
			alert("not a valid e-mail address");
			document.getElementById("eml").focus();
			return false;
		 }
		}
		var mb=document.getElementById("mbl").value;
			mb=mb.trim();
			if(mb==""){
			alert("Enter your mobile number");
			document.getElementById("mbl").focus();
			return false;
	}
		if(isNaN(mb)){
			alert("Enter only number");
			document.getElementById("mbl").focus();
			return false;
	}
		if(mb.length!=10){
			alert("Enter only 10 digit");
			document.getElementById("mbl").focus();
			return false;
	}
		if(mb[0]<6){
			alert("Enter valid mobile number");
			document.getElementById("mbl").focus();
			return false;
		}
		var ag=document.getElementById("age").value;
		if(ag==""){
			alert("Enter your age");
			document.getElementById("age").focus();
			return false;
		}
		if(isNaN(ag)){
			alert("Enter only number");
			document.getElementById("age").focus();
			return false;
	}
		var ge=document.getElementById("gender").value;
		if(ge==""){
			alert("Enter your Gender");
			document.getElementById("gender").focus();
			return false;
		}
		var pw=document.getElementById("pwd").value;
			pw=pw.trim();
		if(pw==""){
			alert("plz enter password");
			document.getElementById("pwd").focus();
			document.getElementById("pwd").value="";
			return false;
		}
		
	}
	
	
	$(document).ready( function() {
		
		$("#searchterm").keyup( function() {
			let st=$("#searchterm").val();
			st=st.trim();
			if(st==""){
				$("#searchhints").hide();
			}else{
				datastring='searchterm='+st;
				$.ajax({
					type: 'POST',
					url: 'testajax.php',
					data: datastring,
					beforeSend: function() {
						//alert("Ready to go");
					},
					success: function( result ) {
						$("#searchhints").show();
						$("#searchhints").html(result);
					},
					error: function() {
						alert("Error AA Gyi");
					},
					complete: function() {
						//alert("Complete");
					}
				});
			}
		});
		
		$(".postdeletebtn").click( function() {
			var x=$(this);
			let delete_id=$(this).val();
			delete_id=delete_id.trim();			
			datastring='delete_id='+delete_id;
			$.ajax({
				type: 'POST',
				url: 'testajax.php',
				data: datastring,
				beforeSend: function() {
					//alert("Ready to go");
				},
				success: function( result ) {
					//alert(result);
					x.closest("div.mb-3").html(result);
				},
				error: function() {
					alert("Error AA Gyi");
				},
				complete: function() {
					//alert("Complete");
				}
			});
			
		});
		
	});	