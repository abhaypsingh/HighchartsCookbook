var underscore = require('underscore');
var os = require('os');
var fs = require('fs');
var path = require('path');

var sum = function(p, n) {
    return p + n;
}

var get_cpu_percentages = function(time) {
    var cpus = os.cpus();
    var timestamp = time || new Date();
    
    // Just get idle v. non-idle
    var cpu_percentages = underscore.map(cpus, function(cpu, key) {
        var values = underscore.values(cpu.times);
        var total = underscore.reduce(values, sum, 0);
        var idle = cpu.times.idle;
        
        return {
            'percent': parseFloat((((total - idle) * 100) / total).toFixed(1)),
            'usage': (total - idle),
            'total': total,
            'time': timestamp.getTime(),
            'id': key
        }
    });
    
    return cpu_percentages;
};

var git = require('gift');
// Note: You will need to change this path to that of
// a git repository on your local machine.
var repo = git('../../../../../code/pelican-plugins');

var express = require('express');
var app = express();
app.use(express.json());
app.use(express.static(__dirname));

app.get('/git/users', function(request, response) {
    repo.commits('master', -1, function(err, commits) {
        // Pluck the user from each commit
        //user_commits = underscore.pluck(commits, 'author');
        
        // Count the user
        user_counts = underscore.countBy(commits, function(commit) {
            return commit.author.name;
        });
        
        // Convert to list
        counts = underscore.pairs(user_counts);
        
        // Sort by most commits first
        sorted_counts = underscore.sortBy(counts, function(x) {
            return x[1];
        });
        
        // Respond with result
        response.json(sorted_counts);
    });
});

app.get('/git/timeline', function(request, response) {
    repo.commits('master', -1, function(err, commits) {
        // Group commits by day
        commits_per_day = underscore.countBy(commits, function(commit) {
            var date = commit.authored_date;  // Alt. use `committed_date`
            var day = new Date(date.getFullYear(), date.getMonth(), date.getDate());
            return day.getTime();
        });
        
        // Convert to list
        commits = underscore.pairs(commits_per_day);
        
        // JSON can't have integer keys; convert string keys to ints again
        commits = underscore.map(commits, function(item) {
            key = parseInt(item[0]);
            value = item[1];
            return [key, value];
        });
        
        // Sort the dates; Highcharts has problems with unsorted data
        commits = underscore.sortBy(commits, function(x) {
            return x[0];
        });
        
        // Respond with result
        response.json(commits);
    });
});

app.get('/cpu/', function(request, response) {
    response.json(get_cpu_percentages());
});

app.get('/cpu/combined', function(request, response) {
    var timestamp = new Date();
    var percentages = get_cpu_percentages(timestamp);
    var usages = underscore.pluck(percentages, 'usage');
    var totals = underscore.pluck(percentages, 'total');
    
    var total_usage = underscore.reduce(usages, sum, 0);
    var total_time = underscore.reduce(totals, sum, 0);
    
    var result = {
        'percent': ((total_usage * 100) / total_time).toFixed(1),
        'usage': total_usage,
        'total': total_time,
        'time': timestamp.getTime()
    };
    
    response.json(result);
});

app.get('/memory/', function(request, response) {
    // Memory is reported in bytes
    var timestamp = new Date();
    var free = os.freemem();
    var total = os.totalmem();
    var used = total - free;
    
    response.json([{
        'percent': parseFloat(((used * 100) / total).toFixed(1)),
        'usage': used,
        'total': total,
        'time': timestamp.getTime(),
        'id': 'RAM'
    }]);
});

app.post('/directory', function(request, response) {
    var dir = request.body.path;
    
    // Get a list of files
    var file_list = fs.readdirSync(dir);
    
    // Generate file statistics 
    var files = underscore.map(file_list, function(file) {
        var filepath = path.join(dir, file);
        var file_obj = fs.lstatSync(filepath);
        var is_directory = file_obj.isDirectory();
        var size;
        var type;
        
        /*
        Because file systems generally do not know how large a directory is,
        only how large individual files are, without recursing through
        sub-directories, we do not calculate directory sizes. 
        */
        if (is_directory) {
            type = 'directory';
            size = 0;
        } else {
            type = 'file';
            size = file_obj.size;
        }
        
        
        // Note: Sizes are in bytes
        return {
            'name': file,
            'path': filepath,
            'type': type,
            'size': size
        }
    });
    
    var objects = underscore.groupBy(files, function(elem) {
        return elem.type;
    })
    
    var sorted_files = underscore.sortBy(objects.file, function(x) {
        return x.size;
    }).reverse();
    
    var sorted_dirs = underscore.sortBy(objects.directory, function(x) {
        return x.name;
    });
    
    response.json({
        files: sorted_files,
        directories: sorted_dirs
    });
});

app.listen(8888);
console.log('Listening on port 8888');
