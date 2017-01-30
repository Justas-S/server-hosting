
<script>
    export default {
        props: [
            '_ip',
            '_gameservers',
        ],
        data: function() {
            return {
                duration: 7,
                gameservers: JSON.parse(this._gameservers),
                ip: this._ip,
                price: 0.0,
                isSelected: true,
            }
        },
        created() {
            //this.gameservers = JSON.parse(this._gameservers);
            /*
            var e = document.getElementById("ip");
            for(var i = 0; i < e.options.length; i++) {
                var option = e.options.item(i);
                if(option.value == this._ip) {
                    e.options.item(i).selected = true;
                }
            }
          
            this.ip = e.options[e.selectedIndex].text;*/
            this.updatePrice();
        },
        methods: {
            updatePrice: function () {
                var that = this;
                this.gameservers.forEach(function (server) {
                    if(server.ip == that.ip) {
                        that.price = Math.round(server.hourly_cost * that.duration * 100) / 100;
                    }
                });
            }
        }

    }
</script>
