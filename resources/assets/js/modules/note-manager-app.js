

new Vue({
    el: '#note-manager-app',

    data: {
        notes: [],
        loading: false,
        include_share: false,
        restore: false,
        deleted_note_id: null,
        search: '',
        new_note: {
            title: '',
            description: '',
            color_id: null
        },
        edit_note: {
            title: '',
            description: '',
            color_id: null
        },
        share_user_list: [],
        new_share: {
            email: '',
            modify: false
        },
        loading_shares: false,
        editing_note: null,
        sharing_note: null
    },

    ready: function () {
        this.loadNotes();
    },

    methods: {
        submitCreateNote: function (event) {
            event.preventDefault();

            $('#createNote').modal('hide');

            this.$http.post('/api/notes/create', this.new_note).then(function (response) {
                this.notes.push(response.json())
            }, function () {
                alert('Something Went Wrong');
            });

            this.clearCreateNoteForm();
        },
        restoreDeletedNote: function () {
            this.$http.get('/api/notes/restore/' + this.deleted_note_id).then(function (response) {
                this.notes.push(response.json())
            }, function () {
                alert('Something Went Wrong');
            });
        },
        clearCreateNoteForm: function () {
            this.new_note = {
                title: '',
                description: '',
                color_id: null
            }
        },
        clearEditNoteForm: function () {
            this.edit_note = {
                title: '',
                description: '',
                color_id: null
            }
        },
        includeShares: function () {
            this.notes = [[]];

            this.loadNotes();
        },
        loadNotes: function () {
            this.loading = true;

            this.$http.get('/api/notes?shares=' + this.include_share).then(function (response) {
                this.notes = response.json();
                $('.loading').removeClass('loading');
                this.loading = false;
            }, function () {
                this.loading = false;
                alert('Something Went Wrong');
            });
        },
        deleteNote: function (note) {
            var self = this;

            self.$http.get('/api/notes/delete/' + note.id).then(function (response) {
                self.deleted_note_id = note.id;
                self.notes.$remove(note);
                self.restore = true;
                setTimeout(function () {
                    self.restore = false;
                }, 3000);
            }, function () {
                alert('Something Went Wrong');
            });
        },
        editNote: function (note) {
            this.editing_note = note;
            this.edit_note = {
                title: note.title,
                description: note.description,
                color_id: note.color_id
            };

            $('#editNote').modal('show');
        },
        shareNote: function (note) {
            this.initShareNoteModal(note);

            this.$http.get('/api/notes/share/' + note.id + '/list').then(function (response) {
                this.share_user_list = response.json();
                this.loading_shares = false;
            }, function () {
                alert('Something Went Wrong');
            });
        },
        initShareNoteModal: function (note) {
            this.share_user_list = [];
            this.sharing_note = note;
            this.loading_shares = true;
            this.clearNewShareForm();

            $('#shareNote').modal('show');
        },
        submitEditNote: function () {
            var self = this;
            event.preventDefault();

            $('#editNote').modal('hide');

            self.$http.post('/api/notes/edit/' + this.editing_note.id, this.edit_note).then(function (response) {
                self.notes.$set(self.notes.indexOf(self.editing_note), response.json());
            }, function () {
                alert('Something Went Wrong');
            });

            self.clearCreateNoteForm();
        },
        deleteShareUser: function (user) {
            this.$http.post('/api/notes/share/' + this.sharing_note.id + '/remove', {email: user.email}).then(function (response) {
                this.share_user_list.$remove(user)
            }, function () {
                alert('Something Went Wrong');
            });

        },
        addNewShare: function () {
            this.$http.post('/api/notes/share/' + this.sharing_note.id + '/add', this.new_share).then(function (response) {
                this.share_user_list.push(response.json());
                this.clearNewShareForm();
            }, function () {
                alert('Something Went Wrong');
            });
        },
        clearNewShareForm: function () {
            this.new_share = {
                email: '',
                modify: false
            }
        }
    }
});