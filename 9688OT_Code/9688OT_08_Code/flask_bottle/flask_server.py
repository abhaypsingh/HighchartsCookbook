#!/usr/bin/env python2.7
from flask import Flask, Response
import json
import random

app = Flask(__name__)

r = lambda: random.randint(0,100)

@app.route('/ajax/series')
def series():
    series = []
    for x in xrange(0,11):
        series.append({
            'y': r()
        })
        
    return Response(json.dumps(series), mimetype='application/json')

@app.route('/ajax/point')
def point():
    point = {
        'y': r()
    }
    return Response(json.dumps(point), mimetype='application/json')
    
if __name__ == '__main__':
    app.run(debug=True)
