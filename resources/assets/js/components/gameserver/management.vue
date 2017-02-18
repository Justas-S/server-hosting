<template>
    <div class="gameserver-general-container">
        <form>
            <div class="form-group row">
                <label class="col-form-label col-md-3" for="version">Versija</label>    
                <div class="col-md-4">
                    <input type="text" name="version" disabled="1" id="version" class="form-control" v-model="version">
                </div>
                <div class="col-md-2">
                    <a href="#">Keisti</a>
                </div>
            </div>
            <div class="row form-group" :class="{ 'has-error': errors.language }">
                <label class="col-form-label col-md-3" for="lang">Kalba</label>
                <div class="col-md-4">
                    <input type="text" name="lang" id="lang" class="form-control" :disabled="disabled" v-model="config.language" />
                </div>
                <label class="text-danger" v-if="errors.language" v-text="errors.language[0]"></label>
            </div>
            <div class="row form-group" :class="{ 'has-error': errors.mapname }">
                <label class="col-form-label col-md-3" for="map">Žemėlapis</label>
                <div class="col-md-4">
                    <input type="text" name="map" id="map" class="form-control" :disabled="disabled" v-model="config.mapname" />
                </div>
                <label class="text-danger" v-if="errors.mapname" v-text="errors.mapname[0]"></label>
            </div>
            <div class="row form-group" v-bind:class="{ 'has-error': errors.maxnpc }">
                <label class="col-form-label col-md-3" for="maxnpc">Max. NPC</label>
                <div class="col-md-4">
                    <input type="number" id="maxnpc" name="maxnpc" class="form-control" :disabled="disabled" v-model="config.maxnpc" />
                </div>
                <label class="text-danger" v-if="errors.maxnpc" v-text="errors.maxnpc[0]"></label>
            </div>
            <div class="row form-group" :class="{ 'has-error': errors.rcon_password }">
                <label class="col-form-label col-md-3" for="rcon">RCON slaptažodis<i v-show="loadingRcon" class="fa fa-spinner fa-spin"></i></label>
                <div class="col-md-4">
                    <input type="text" name="rcon" id="rcon" class="form-control" :disabled="disabled || rconDisabled" v-model="config.rcon_password" />
                </div>
                <a href="#auth-modal" data-toggle="modal" class="col-md-2" v-if="!config.rcon_password">Rodyti</a>
                <label class="text-danger" v-if="errors.rcon_password" v-text="errors.rcon_password[0]"></label>
            </div>
            <div class="row form-group">
                <div class="col-md-2 offset-md-6">
                    <button type="submit" class="btn btn-primary" @click.prevent="submitConfig" :disabled="disabled"><i v-show="disabled" class="fa fa-spinner fa-spin"></i> Atnaujinti</button>
                </div>
            </div>
        </form>
        <auth-modal method="POST" action="/" title="Prisijunkite kad būtų parodytas RCON slaptažodis" v-on:submit="authSubmit($event)">
            
        </auth-modal>
    </div>
</template>

<script>
    export default {
        props: [
            'gameserverId'
        ],
        data: function() {
            return {
                disabled: true,
                gameserver: null,
                config: { },
                rconDisabled: true,
                version: '',
                errors: { },
                loadingRcon: false,
            };
        },
        mounted() {
            this.$http.get('/ajax/gameservers/' + this.gameserverId + '/server.cfg').then(response => {
                this.config = JSON.parse(response.body);
                this.disabled = false;
            }, error => {
                alert(error.body);
            });

            this.$http.get('/ajax/gameservers/' + this.gameserverId).then(response => {
                this.gameserver = JSON.parse(response.body);
                this.version = this.gameserver.server_package.name + ":" + this.gameserver.server_package.version;
            }, error => {
                alert(error.body);
            });
        },
        methods: {
            authSubmit: function(e) {
                if(this.config.rcon_password) return; 
                this.loadingRcon = true;
                this.$http.post('/ajax/gameservers/' + this.gameserverId + "/rcon", e).then(response => {
                    if(response.status == 200) {
                        this.config.rcon_password = JSON.parse(response.data);
                        this.rconDisabled = false;
                        this.loadingRcon = false;
                    } else {
                        alert("Vartotojo vardas ir/ar slaptažodis neteisingas");
                    }
                }, error => {
                    alert(error.body);
                })
            },
            submitConfig: function() {
                this.disabled = true;
                this.$http.post('/ajax/gameservers/' + this.gameserverId + "/server.cfg", this.config).then(response => {
                    if(response.status == 200) {
                        this.disabled = false;
                    } else {
                        alert(response.body);
                    }
                }, error => {
                    this.errors = error.body;
                    this.disabled = false;
                });
            }
        }
    }
</script>
