var express = require('express'),
    app = express();
var bodyParser = require('body-parser');
var meal = require("./Model/meal");
var user = require("./Model/user");
var workout = require("./Model/workout")
var unirest = require('unirest');
var session = require('express-session');
var loggedInUser;

console.log(__dirname + '/public');
app.use(express.static(__dirname + '/public'));
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());
app.use(session({ secret: 'Ralph The Turtle', 
    resave: true,
    saveUninitialized: true,
}));

app.get("/meal", function(req, res){
  if(req.session.user) {
    meal.get(null, req.session.user.id, function(err, rows){
      res.send(rows);
    })
  }
})
.get("/currentUser", function(req, res){
    res.send(loggedInUser);
})
.get("/meal/:id", function(req, res){
  
  meal.get(req.params.id, function(err, rows){
    res.send(rows[0]);
  })
  
})
.post("/meal", function(req, res){
  var errors = meal.validate(req.body);
  if(errors){
    res.status(500).send(errors);
    return;
  }
  meal.save(req.body, req.session.user.id, function(err, row){
    res.send(row);
  })
})
.delete("/meal/:id", function(req, res){
  
  meal.delete(req.params.id, function(err, rows){
      if(err){
        res.status(500).send(err);
      }else{
        res.send(req.params.id);
      }
  })
  
})
.get("/meal/search/:term", function(req, res){
    unirest.get("https://nutritionix-api.p.mashape.com/v1_1/search/" + req.params.term + "?fields=item_name%2Citem_id%2Cbrand_name%2Cnf_calories%2Cnf_total_fat")
    .header("X-Mashape-Key", "IGZgTggKMnmshgiyqWWrppKxwDR0p1FvHGAjsngCvRgN3P5X6V")
    .header("Accept", "application/json")
    .end(function (result) {
        res.send(result.body);
    });
})
app.get("/workout", function(req, res){
  if(req.session.user) {
    workout.get(null, req.session.user.id, function(err, rows){
      res.send(rows);
    })
  }
})
.get("/workout/:id", function(req, res){
  
  workout.get(req.params.id, function(err, rows){
    res.send(rows[0]);
  })
  
})
.post("/workout", function(req, res){
  var errors = workout.validate(req.body);
  if(errors){
    res.status(500).send(errors);
    return;
  }
  workout.save(req.body, req.session.user.id, function(err, row){
    res.send(row);
  })
})
.delete("/workout/:id", function(req, res){
  
  workout.delete(req.params.id, function(err, rows){
      if(err){
        res.status(500).send(err);
      }else{
        res.send(req.params.id);
      }
  })
})
app.get("/user", function(req, res){
  user.get(null, function(err, rows){
    res.send(rows);
  })
})
.get("/user/:id", function(req, res){
  user.get(req.params.id, function(err, rows){
    res.send(rows[0]);
  })
})
.post("/login", function(req, res){
  user.get(req.body, function(err,rows){
    req.session.user = rows[0];
    loggedInUser = req.session.user;
    console.log(loggedInUser);
    res.send(rows[0]);
  })
})
app.listen(process.env.PORT);