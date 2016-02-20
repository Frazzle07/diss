Vue.component('files',{
	template: '#files-template',

	props: ['list'],

	created(){
		this.list = JSON.parse(this.list);
	}
})

new Vue({
	el: '#app',

	data: {
		search: ''
	}
	/*ready: function(){
		this.fetchFiles();
	},

	methods: {
		fetchFiles: function() {
			this.$http.get('/api/messages', function(files){
				this.$set('files', files);
			});
		}
	}*/
})