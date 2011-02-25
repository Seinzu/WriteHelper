class ProjectModel extends Backbone.Model 

  EMPTY: "no projects"

  initialize: ->
    if (!this.get("content"))
      this.set({"content": this.EMPTY})

  clear: ->
    this.destroy()
    this.view.remove()
