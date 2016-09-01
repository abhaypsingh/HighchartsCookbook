test("Failing test example", function() {
    ok(false, "This test fails, for demonstration purposes.");
});

test("MyExtension", function() {
    ok(MyExtension, "MyExtension doesn't exist.");
});

test("MyExtension.getVersionInfo", function() {
    var actual, expected;
    
    actual = MyExtension.getVersionInfo();
    expected = "MyExtension - 1.0 (2013-11-26)";
    equal(actual, expected, "Wrong version info.")
});

test("MyExtension.SpiderWebChart", function() {
    var actual, expected;
    
    ok(MyExtension.SpiderWebChart, "SpiderWebChart doesn't exist.")
    
    throws(function(){
        new MyExtension.SpiderWebGraph();
    }, "SpiderWebChart needs arguments.");
});
