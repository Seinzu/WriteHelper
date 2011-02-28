(function() {
  var AuthorController, AuthorView, HomeView, MainController, ProjectCollection, ProjectController, ProjectListView, ProjectModel, ProjectView, TextCollection, TextController, TextModel, TextView;
  var __hasProp = Object.prototype.hasOwnProperty, __extends = function(child, parent) {
    for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; }
    function ctor() { this.constructor = child; }
    ctor.prototype = parent.prototype;
    child.prototype = new ctor;
    child.__super__ = parent.prototype;
    return child;
  };
  window.app = {};
  app.controllers = {};
  app.models = {};
  app.views = {};
  app.collections = {};
  $(document).ready(function() {
    app.controllers.main = new MainController();
    app.controllers.text = new TextController();
    app.controllers.project = new ProjectController();
    app.views.home = new HomeView();
    app.collections.projects = new ProjectCollection(new ProjectModel({
      name: "test"
    }));
    if ('' === Backbone.history.getFragment()) {
      Backbone.history.saveLocation("home");
    }
    return Backbone.history.start();
  });
  ProjectCollection = (function() {
    function ProjectCollection() {
      ProjectCollection.__super__.constructor.apply(this, arguments);
    }
    __extends(ProjectCollection, Backbone.Collection);
    ProjectCollection.model = ProjectModel;
    ProjectCollection.prototype.url = 'http://localhost:4567/projects';
    return ProjectCollection;
  })();
  ProjectModel = (function() {
    function ProjectModel() {
      ProjectModel.__super__.constructor.apply(this, arguments);
    }
    __extends(ProjectModel, Backbone.Model);
    ProjectModel.prototype.EMPTY = "";
    ProjectModel.prototype.initialize = function() {
      if (!this.get("name")) {
        return this.set({
          "name": this.EMPTY
        });
      }
    };
    ProjectModel.prototype.clear = function() {
      this.destroy();
      return this.view.remove();
    };
    return ProjectModel;
  })();
  TextCollection = (function() {
    function TextCollection() {
      TextCollection.__super__.constructor.apply(this, arguments);
    }
    __extends(TextCollection, Backbone.Collection);
    return TextCollection;
  })();
  TextModel = (function() {
    function TextModel() {
      TextModel.__super__.constructor.apply(this, arguments);
    }
    __extends(TextModel, Backbone.Model);
    return TextModel;
  })();
  AuthorController = (function() {
    __extends(AuthorController, Backbone.Controller);
    AuthorController.prototype.routes = {
      "author": "index"
    };
    function AuthorController() {
      AuthorController.__super__.constructor.apply(this, arguments);
    }
    AuthorController.prototype.index = function() {
      var author;
      author = new AuthorView();
      return author.render();
    };
    return AuthorController;
  })();
  MainController = (function() {
    __extends(MainController, Backbone.Controller);
    MainController.prototype.routes = {
      "home": "home"
    };
    function MainController() {
      MainController.__super__.constructor.apply(this, arguments);
    }
    MainController.prototype.home = function() {
      return app.views.home.render();
    };
    return MainController;
  })();
  ProjectController = (function() {
    var view;
    __extends(ProjectController, Backbone.Controller);
    ProjectController.prototype.routes = {
      "project": "index",
      "project/view/:pid": "view"
    };
    function ProjectController() {
      ProjectController.__super__.constructor.apply(this, arguments);
    }
    ProjectController.prototype.index = function() {
      var projectView;
      projectView = new ProjectListView();
      return projectView.render();
    };
    view = function(pid) {
      var project, projectView;
      project = new ProjectModel();
      projectView = new ProjectView({
        model: project
      });
      return project.render();
    };
    return ProjectController;
  })();
  TextController = (function() {
    __extends(TextController, Backbone.Controller);
    TextController.prototype.routes = {
      "text": "index"
    };
    function TextController() {
      TextController.__super__.constructor.apply(this, arguments);
    }
    TextController.prototype.index = function() {
      var text;
      text = new TextView();
      return text.render();
    };
    return TextController;
  })();
  AuthorView = (function() {
    function AuthorView() {
      AuthorView.__super__.constructor.apply(this, arguments);
    }
    __extends(AuthorView, Backbone.View);
    AuthorView.prototype.id = 'author-view';
    AuthorView.prototype.render = function() {
      $(this.el).html(app.templates.header()).appendTo($("body"));
      return $("<p>").html("Author here").appendTo($("body"));
    };
    return AuthorView;
  })();
  HomeView = (function() {
    function HomeView() {
      HomeView.__super__.constructor.apply(this, arguments);
    }
    __extends(HomeView, Backbone.View);
    HomeView.prototype.id = 'home-view';
    HomeView.prototype.render = function() {
      return $(this.el).html(app.templates.home()).appendTo($('body'));
    };
    return HomeView;
  })();
  ProjectListView = (function() {
    var createProject;
    function ProjectListView() {
      ProjectListView.__super__.constructor.apply(this, arguments);
    }
    __extends(ProjectListView, Backbone.View);
    ProjectListView.prototype.id = 'project-list-view';
    ProjectListView.prototype.events = {
      "click #project-submit": "createProject"
    };
    ProjectListView.prototype.initialize = function() {
      return this.delegateEvents(this.events);
    };
    createProject = function(data) {
      var nameField;
      console.log("here");
      nameField = $('input[name=projectName]');
      app.collections.projects.create({
        name: nameField.val()
      });
      nameField.val('');
      return false;
    };
    ProjectListView.prototype.render = function() {
      var data, output, projects;
      projects = app.collections.projects.fetch();
      $(this.el).html(app.templates.header()).appendTo($("body"));
      $("<p>").html('this is the list view').appendTo($("body"));
      data = projects.map(function(project) {
        return project.get('name') + '\n';
      });
      output = data.reduce(function(memo, str) {
        return memo + str;
      });
      $("<ul>").addClass('projectList').html(output).appendTo($("body"));
      return $("<div>").html(app.templates.newProjectForm()).appendTo($("body"));
    };
    return ProjectListView;
  })();
  ProjectView = (function() {
    function ProjectView() {
      ProjectView.__super__.constructor.apply(this, arguments);
    }
    __extends(ProjectView, Backbone.View);
    ProjectView.prototype.id = 'project-view';
    ProjectView.prototype.render = function() {
      return $(this.el).html(app.templates.header()).appendTo($("body"));
    };
    return ProjectView;
  })();
  TextView = (function() {
    function TextView() {
      TextView.__super__.constructor.apply(this, arguments);
    }
    __extends(TextView, Backbone.View);
    TextView.prototype.id = 'text-view';
    TextView.prototype.render = function() {
      $(this.el).html(app.templates.header()).appendTo($("body"));
      return $("<p>").html("Text here").appendTo($("body"));
    };
    return TextView;
  })();
}).call(this);
