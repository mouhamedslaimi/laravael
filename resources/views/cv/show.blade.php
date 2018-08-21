@extends('layouts.app')
@section('content')

<div class="container" id="app">
	<div class="row">
		<div class="col-md-12">
        <a href="{{ url('cvs') }}" class="btn btn-primary" role="button">Retour</a>
        <hr>
            <div class="card">
                <div class="card-header">
                <div class="row">
                        <div class="col-md-10"><h3 class="panel-title">Experience</h3></div>
                        <div class="col-md-2 text-right">
                            <button class="btn btn-success" @click="open = true">Ajouter</button>
                        </div>
                    </div>                   
                    </div>
                <div class="card-body">
                <div v-if="open">
                    <div class="form-group">
                     <label for="">Titre</label>
                        <input type="text" class="form-control" placeholder="le titre" v-model="experience.titre">
                    </div>
                    <div class="form-group">
                     <label for="">Body</label>
                         <textarea type="text" class="form-control" placeholder="le contenu" v-model="experience.body"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Date-debut</label>
                              <input type="date" class="form-control" placeholder="Debut" v-model="experience.debut">
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                              <label for="">Date-fin</label>
                              <input  type="date" class="form-control" placeholder="Fin" v-model="experience.fin">
                            </div>
                        </div>
                    </div>
                    <button @click="addExperience" class="btn btn-info btn-block">Ajouter</button>
                    <hr>
                </div>
                <ul class="list-group" >
						<li class="list-group-item" v-for="experience in experiences ">
							<div class="pull-right">
								<button class="btn btn-warning btn-sm" style="margin-left:90%">Editer</button>
							</div>
							<h3>@{{ experience.titre }} </h3>
							<p>@{{ experience.body }}</p>
							<small> @{{ experience.debut }} - @{{ experience.fin }}</small>
						</li>
					</ul>
                </div>
            </div>
            

		</div>
	</div>
</div>
@endsection
@section('javascripts')

<script src="{{ asset('js/vue.min.js') }}" type="text/javascript"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="text/javascript">
       
 window.Laravel = {!! json_encode([
            'csrfToken'  => csrf_token(),
            'idExperince'        =>1,
            'url'       =>url('/')
        ]) !!};
    </script>
<script type="text/javascript">

	var app = new Vue({
       el: '#app',
       data: {
       	message: 'je suis Mohamed ',
        experiences : [],
        open : false,
        experience : {
            id: 0,
            titre : '',
            body : '',
            debut : '',
            fin : '',
            cv_id : window.Laravel.idExperince
        }
       },
       methods :{
           getExperiences : function(){
               axios.get(window.Laravel.url+'/getexperiences/'+window.Laravel.idExperince)
               .then(response => {
                   this.experiences = response.data;
                   console.log(axios.get);

               })
               .catch(error => {
                   console.log('errors : ' ,error);
                   console.log(axios.get);

                   
               })
           },
           addExperience : function(){
               axios.post(window.Laravel.url+'/addexperience',this.experience)
               .then(response => {
                   if(response.data.etat){
                       this.open =false;
                       this.experiences.push(this.experience);

                   }
               })
               .catch(error => {
                   console.log('errors : ' ,error);
               })
           }
       },
       created:function(){
           this.getExperiences();
           console.log(this.$route);

       }
    
	});
</script>

@endsection