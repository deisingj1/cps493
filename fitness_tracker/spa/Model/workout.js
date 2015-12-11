var mysql = require("mysql");

module.exports =  {
    blank: function(){ return {} },
    get: function(id, userId, ret){
        var conn = GetConnection();
        var sql = 'SELECT * FROM FT_workouts where user_id = ' + userId;
        if(id){
          sql += ",id = " + id;
        }
        conn.query(sql, function(err,rows){
          ret(err,rows);
          conn.end();
        });        
    },
    delete: function(id, ret){
        var conn = GetConnection();
        conn.query("DELETE FROM FT_workouts WHERE id = " + id, function(err,rows){
          ret(err);
          conn.end();
        });        
    },
    save: function(row, userId, ret){
        var sql;
        var conn = GetConnection();
        //  TODO Sanitize
        if (row.id) {
				  sql = " Update FT_workouts "
							+ " Set workout=?, time=?, calories=?, edit_time=Now()"
						  + " WHERE id = ? ";
			  }else{
				  sql = "INSERT INTO FT_workouts "
						  + " (workout, time, calories, create_time, user_id) "
						  + "VALUES (?, ?, ?, Now(), " + userId + ") ";				
			  }
        conn.query(sql, [row.workout, row.time, row.calories, row.id, userId],function(err,data){
          if(!err && !row.id){
            row.id = data.insertId;
          }
          ret(err, row);
          conn.end();
        });        
    },
    validate: function(row){
      var errors = {};
      
      if(!row.workout) errors.workout = "is required"; 
      
      return errors.length ? errors : false;
    }
};  

function GetConnection(){
        var conn = mysql.createConnection({
          host: "localhost",
          user: "jesse",
          password: "9221",
          database: "c9"
        });
    return conn;
}