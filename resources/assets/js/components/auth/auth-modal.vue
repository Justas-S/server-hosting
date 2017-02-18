<template>
<div class="modal fade" id="auth-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="myModalLabel">{{ title }}</h3>
      </div>
        <form :method="method" :action="action">
            <div class="modal-body">
                <div class="form-group row">
                  <label class="col-form-label col-md-4" for="username">Vartotojo vardas</label>
                  <div class="col-md-8">
                    <input type="text" name="username" class="form-control" v-model="username" />
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-form-label col-md-4">Slaptažodis</label>
                  <div class="col-md-8">
                    <input type="password" name="password" class="form-control" v-model="password" />
                  </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Uždaryti</button>
                <button type="submit" class="btn btn-primary" @click.prevent="onSubmit" data-dismiss="modal">Prisijungti</button>
            </div>
        </form>
    </div>
  </div>
</div>
</template>

<script>
    export default {
        props: [
            'method',
            'action',
            'title',
        ],
        data: function() {
            return {
                username: '',
                password: '',
            };
        },
        methods: {
            onSubmit: function() {
                console.log("auth modal submit");
                this.$emit('submit', {username: this.username, password: this.password });
            }
        },
    
    }
</script>
