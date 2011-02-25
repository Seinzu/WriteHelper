class ProjectListView extends Backbone.View
  id: 'project-list-view'
  events: {"submit #new-project-form": "createProject"}

  createProject = (data) ->
    console.log("here")
    nameField = $('input[name=projectName]')
    app.collections.projects.create({name: nameField.val()})
    nameField.val('')

  render: ->
    console.log(this.options.container)
    $(@.el) .html(app.templates.header())
            .appendTo($("body"))
    $("<p>").html('this is the list view')
            .appendTo($("body"))
    $("<div>").html(app.templates.newProjectForm())
              .appendTo($("body"))
