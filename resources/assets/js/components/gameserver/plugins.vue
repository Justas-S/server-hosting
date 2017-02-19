<template>
    <div class="plugin-container">
        <div class="row">
            <div class="col-md-5 form-group">
                <label class="col-form-label" for="server_plugins">Dabartiniai plugin</label>
                <select multiple="1" name="server_plugins" id="server_plugins"  :disabled="disabled" class="form-control" v-model="selectedPlugins">
                    <option v-for="plugin in installedPlugins" v-text="plugin.text" :value="plugin.value"></option>
                </select>
            </div>
            <div class="col-md-7">  
                <button type="button" class="btn" :disabled="disabled || !selectedPlugins.length" @click="remove">Pašalinti</button>
                <div class="row">
                    <div class="col-md-6">
                        <select name="available_plugins" id="available_plugins" :disabled="disabled" class="form-control pull-left" v-model="selectedPlugin"> 
                            <option v-for="plugin in availablePlugins" v-text="plugin.text" :value="plugin.value"></option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn" :disabled="disabled" @click="add">Pridėti</button>
                    </div>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary" :disabled="disabled" @click="save"><i v-show="disabled" class="fa fa-spinner fa-spin"></i> Išsaugoti</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: [
            'gameserverId',
            'gameId',
        ],
        data: function() {
            return {
                selectedPlugins: [],
                selectedPlugin: null,
                availablePlugins: [],
                installedPlugins: [],
                disabled: true,
            };
        },
        mounted() {
            var r1 = this.$http.get('/ajax/gameservers/' + this.gameserverId + '/plugins').then(response => {
                var plugins = JSON.parse(response.body);
                this.installedPlugins = []; 
                plugins.forEach(plugin => this.installedPlugins.push(this.format(plugin)));
            }, error => {           
                alert(error.body);
            });

            var r2 = this.$http.get('/api/plugin?game_id=' + this.gameId + '/').then(response => {
                var plugins = response.body;
                this.availablePlugins = [];
                plugins.forEach(plugin => this.availablePlugins.push(this.format(plugin)));
                this.selectedPlugin = this.availablePlugins.length > 0 ? this.availablePlugins[0].value : 0;
            }, error => {
                alert(error.body);
            });

            Promise.all([r1, r2]).then(values => {
                this.disabled = false;
            })
        },
        methods: {
            add: function() {
                if(this.installedPlugins.map(plugin => plugin.value).indexOf(this.selectedPlugin) != -1) return;

                this.installedPlugins.push(this.availablePlugins.find(plugin => plugin.value == this.selectedPlugin));
            },
            remove: function () {
                this.selectedPlugins.forEach(plugin => this.installedPlugins.splice(this.installedPlugins.map(p => p.value).indexOf(plugin), 1))
            },
            format: function(plugin) {
                return { text: plugin.name + "-" + plugin.version, value: plugin.id };
            },
            save: function() {
                this.disabled = true;
                var values = this.installedPlugins.map(p => p.value);
                this.$http.post('/ajax/gameservers/' + this.gameserverId + '/plugins', { "plugins" :values }).then(response => {
                    this.disabled = false;
                    alert("Informacija atnaujinta");
                }, error => {
                    alert(error.body);
                    this.disabled = false;
                });
            }
        }
    }
</script>