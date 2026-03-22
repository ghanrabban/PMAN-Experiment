<?php  
$myurl = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$myurl = str_replace("/view/domestic_display1/","",$myurl);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="../../xcrud/plugins/bootstrap-5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="../js/jquery/jquery.js"></script>
    <title>Parking</title>
    <style>
        @font-face {
            font-family: 'Montserrat';
            src: url('fonts/Montserrat-Bold.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        html, body {
            height: 100%;
        }
        body {
            padding: 0;
            margin: 0;
        }
        .container {
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
            height: 130px;
            width: 440px;
            font-family: 'Open Sans', Arial, sans-serif;
        }
        .header {
            display: flex;            
        }
        .header .logo {
            padding-left: 24px;
        }
        .header .title {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            text-transform: uppercase;
        }
        .content-container {
            flex-grow: 1;
            display: grid;
            gap: 0;
        }
        .item {
            display: flex;
            flex-direction: column;
            background-color: black;
            font-size: 2.1em;
            font-weight: bold;
            color: red;
            border: 0px #fff solid;
            text-shadow: 
                -2px -2px 0 #fff, 
                2px -2px 0 #fff,
                -2px 2px 0 #fff,
                2px 2px 0 #fff;
        }
       
        .label, .count {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .label {
            align-items: flex-end;
        }
        .count {
            align-items: flex-start;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="logo2.png" style="width: 50px" />
            </div>
            <div class="title">Available Parking Space</div>
        </div>
        <table width="440px" style="border:0px;border-spacing:0px;">
            <tr>
                <td>
                    <div class="item">
                        <div class="label">P1</div>
                        <div class="count" id="pLt-1">000</div>
                    </div>
                </td>
                <td>
                    <div class="item">
                        <div class="label">P2</div>
                        <div class="count" id="pLt-2">000</div>
                    </div>
                </td>
                <td>
                    <div class="item">
                        <div class="label">P3</div>
                        <div class="count" id="pLt-3">000</div>
                    </div>
                </td>
                <td>
                    <div class="item">
                        <div class="label">P4</div>
                        <div class="count" id="pLt-4">000</div>
                    </div>
                </td>
            </tr>
        </table>        
    </div>
    <script type="text/javascript">
    $(document).ready(function() {
		get_data();
        

		setInterval(get_data, 20000); 
	});

    function get_data(){ 
		var i = 0;  
		var max_showed = 3;  
		var flight_data = '';
		$.ajax({
			url:"http://localhost/api2/count/view/?code=DI&custom=adjust",
			dataType:"json",
			error:function(){  
				//alert('e');
			},
			success:function(data){
				$.each(data, function(key1, value1) {
                    $.each(value1, function(key2, value2) {
                        if(key2 != 0)
                        {
                            $("#p" + key2).empty();
                            $("#p" + key2).text(value2);
                        }
                    });
                });
			}

		});
		
		return false;	
	}
    </script>
</body>
</html>