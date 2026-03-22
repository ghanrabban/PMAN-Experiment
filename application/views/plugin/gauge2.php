
<script src="<?= base_url("assets") ?>/js/plugins/gauge2/jqxcore.js"></script>
<script src="<?= base_url("assets") ?>/js/plugins/gauge2/jqxdraw.js"></script>
<script src="<?= base_url("assets") ?>/js/plugins/gauge2/jqxgauge.js"></script>
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

    #wrapper {
        width: 100%;
        overflow-x: visible;
    }


</style>

<script type="text/javascript">
    $(document).ready(function () {
        var labels = { visible: true, position: 'inside' };
              
          
            
        function gauge(e,percent,width){
            //Create jqxGauge
            e.jqxGauge({
                ranges: [{ startValue: 0, endValue: 60, style: { fill: '#ED5565', stroke: '#ED5565' }, startDistance: '5%', endDistance: '5%', endWidth: 13, startWidth: 13 },
                    { startValue: 60, endValue: 80, style: { fill: '#F8AC59', stroke: '#F8AC59' }, startDistance: '5%', endDistance: '5%', endWidth: 13, startWidth: 13 },
                    { startValue: 80, endValue: 100, style: { fill: '#18A689', stroke: '#18A689' }, startDistance: '5%', endDistance: '5%', endWidth: 13, startWidth: 13 },
                ],
                border: {visible:0},
                max: 100,
                pointer : { pointerType: 'default', style: { fill: '#1C84C6', stroke: '#1C84C6' }, length: '70%', width: '2%', visible: true },
                cap : { size: '4%', style: { fill: '#1C84C6', stroke: '#1C84C6' }},
          
                value: 0,
                style: { stroke: '#ffffff', 'stroke-width': '1px', fill: '#ffffff' },
                animationDuration: 1400,
                colorScheme: 'scheme04',
                labels: labels,
                ticksMinor: { interval: 5, size: '5%' },
                ticksMajor: { interval: 10, size: '10%' },
                endAngle : 180,
                startAngle : 0,
                width:width
            });
            //Initialize the Settings panel.
        
        
            // set gauge's value.
            e.jqxGauge('setValue', percent);
            $("circle[fill='#ffffff']").attr("fill","transparent");
        }
                
        $(".gauge").each(function(){
            var e = $(this);
            var  percent = $(this).attr("percent");
            var  width = $(this).attr("width");
            gauge(e,percent,width); 
        });
        
        $(".progress").each(function(){
            var persen = $(this).attr("percent");
            var e = $(this);
            var persen2 = persen+"%";
        
        
        
            e.children().css("width",persen2);
            e.children().attr("aria-valuenow",persen);
            e.children().children().html(persen2);
        })
            
    });
</script>