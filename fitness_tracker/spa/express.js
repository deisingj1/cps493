var express = require('express'),
    app = express();
var bodyParser = require('body-parser');
var meal = require("./Model/meal");
var workout = require("./Model/workout")

console.log(__dirname + '/public');
app.use(express.static(__dirname + '/public'));
app.use(bodyParser.urlencoded({ extended: false }));

app.get("/meal", function(req, res){
  
  meal.get(null, function(err, rows){
    res.send(rows);
  })
    
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
  meal.save(req.body, function(err, row){
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
app.get("/workout", function(req, res){
  
  workout.get(null, function(err, rows){
    res.send(rows);
  })
    
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
  workout.save(req.body, function(err, row){
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
app.listen(process.env.PORT);