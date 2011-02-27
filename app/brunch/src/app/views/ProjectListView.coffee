class ProjectListView extends Backbone.View
  id: 'project-list-view'
  
  events: 	
    "click #project-submit": "testPopup" 

  initialize: ->
    @.delegateEvents(@.events)
  

  createProject = (data) ->
    console.log("here")
    nameField = $('input[name=projectName]')
    app.collections.projects.create({name: nameField.val()})
    nameField.val('')

  render: ->
    projects = app.collections.projects.fetch()
    $(@.el) .html(app.templates.header())
            .appendTo($("body"))
    $("<p>").html('this is the list view')
            .appendTo($("body"))
    data = projects.map((project)->project.get('name') + '\n')
    output = data.reduce((memo, str) -> memo + str)
    $("<ul>").addClass('projectList')
              .html(output)
              .appendTo($("body"))
    $("<div>").html(app.templates.newProjectForm())
              .appendTo($("body"))
