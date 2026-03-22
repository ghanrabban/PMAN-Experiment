
<link href="<?= base_url("assets") ?>/css/plugins/gauge/jquery-gauge.css" rel="stylesheet"/>

<style>

    @media (min-width: 768px) {
        .demo1 {
            position: absolute;
            width: 400px;
            height: 400px;
        }

        .gauge-wrapper1{
            margin: 0 auto;
            position: relative;
            width: 400px;
            height: 230px;
        }
    }
    @media (max-width: 768px) {
         .demo1 {
        position: absolute;
        width: 175px;
        height: 175px;
    }

    .gauge-wrapper1{
        margin: 0 auto;
        position: relative;
        width: 175px;
        height: 130px;
    }
    }



    .demo2 {
        position: absolute;
        width: 175px;
        height: 175px;
    }

    .gauge-wrapper{
        margin: 0 auto;
        position: relative;
        width: 175px;
        height: 130px;
    }
</style>

<script src="<?= base_url("assets") ?>/js/plugins/gauge/jquery-gauge.min.js"></script>
<script>

    // first example
    var gauge = new Gauge($('.gauge1'), {value: 70});


    function dm_gauge(e,value){
        $(e).gauge({
            values: {
                0 : '0',
                20: '20',
                40: '40',
                60: '60',
                80: '80',
                100: '100'
            },
            colors: {
                0 : '#ED5565',
				
                20: '#F8AC59',
                60: '#18A689'
            },
            angles: [
                180,
                360
            ],
            lineWidth: 10,
            arrowWidth: 7,
            arrowColor:"#1C84C6",
            inset:true,

            value: value
        });  
    }
    
    
    $(".gauge").each(function(){
        var e = $(this); 
        var val = $(this).attr("percent"); 
        dm_gauge(e ,val);
    });

    
    $(".progress").each(function(){
        var persen = $(this).attr("percent");
        var e = $(this);
        var persen2 = persen+"%";
        
        
        
        e.children().css("width",persen2);
        e.children().attr("aria-valuenow",persen);
        e.children().children().html(persen2);
    })

   
        
        
     
</script>