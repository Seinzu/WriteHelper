class ProjectController extends Backbone.Controller
  routes :
    "project": "index"
    "project/view/:pid": "view"

  constructor: ->
    super

  index: ->
    projects = app.collections.projects.fetch()
    console.log(projects)
    projectView = new ProjectListView({container: projects})
    projectView.render()

  view = (pid) ->
    project = new ProjectModel()
    projectView = new ProjectView({model: project})
    project.render()
