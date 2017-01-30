<template>
<form method="POST" class="row" v-on:submit.prevent="submit">
    <div class="form-group row">
        <label for="provider" class="col-md-3 col-form-label">Tiekėjas</label>
        <div class="col-md-8">
            <input type="text" id="provider" name="provider" class="form-control" v-model="serverData.provider" required="required">
        </div>
    </div>
    <div class="form-group row">
        <label for="ip" class="col-md-3 col-form-label">IP adresas</label>
        <div class="col-md-8">
            <input type="text" name="ip" id="ip" class="form-control" v-model="serverData.ip" required="required">
        </div>
    </div>
    <div class="form-group row">
        <label for="password" class="col-md-3 col-form-label"><em>root</em> vartotojo slaptažodis</label>
        <div class="col-md-8">
            <input type="password" name="password" id="password" class="form-control" v-model="serverData.password" required="required">
        </div>
    </div>
    <button v-bind:disabled="buttonDisabled" ref="submitbutton" type="submit" class="btn btn-primary">Pridėti</button>
    <h1>WAt</h1>
</form>
</template>

<script>
    export default {
        props: [
            
        ],
        data: function() {
            return {
                serverData: {
                    provider: '',
                    ip: '',
                    password: ''
                },
                buttonDisabled: false
            }
        },
        methods: {
            submit: function(event) {
                console.log(this.serverData);
                console.log(JSON.stringify(this.serverData));
                console.log("submitbutton: " + this.$refs.submitbutton);
                this.buttonDisabled = true;
                Echo.private('server')
                    .listen('ServerSetUpFailed', (e) => {
                        console.log(e);
                        Echo.leave('server');
                    })
                    .listen('ServerUpdated', () => {
                        console.log(e);
                    });
                this.$http.post('/serveris/prideti', JSON.stringify(this.serverData)).then(function(response) {
                    console.log(response);
                }, function(err) {
                    alert(err);
                    this.buttonDisabled = false;
                })
            }
        }
    }
</script>   