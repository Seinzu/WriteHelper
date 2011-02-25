class ProjectListView extends Backbone.View
  id: 'project-list-view'
  events: {"submit #new-project-form": "testPopup"}

  initialize: ->
    _.bindAll(this, "render")
  
  testPopup: ->
    console.log("tes")

  createProject = (data) ->
    console.log("here")
    nameField = $('input[name=projectName]')
    app.collections.projects.create({name: nameField.val()})
    nameField.val('')

  render: ->
    projects = app.collections.projects.fetch()
    console.log(projects)
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
