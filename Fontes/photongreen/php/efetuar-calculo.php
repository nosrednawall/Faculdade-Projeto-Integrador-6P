<?php 
    include ('Constraint.php');
    include ('Problem.php');
    include ('Solver');

    echo "Hello World!";

    // Define constraints
    // $constraints = [
    //     new Constraint([120, 210, 150.75], LE, 15000),
    //     new Constraint([110, 30, 125], LE, 4000),
    //     new Constraint([1, 1, 1], LE, 75)
    // ];
    // print_r($constraints);

    // Or initialize them from string
    $constraints = [
        Constraint::fromString('120x + 210y + 150.75z <= 15000'),
        Constraint::fromString('110x + 30y + 125z <= 4000'),
        Constraint::fromString('1x + 1y + 1z <= 75')
    ];

    // Define problem
    $problem = new Problem([143, 60, 195], $constraints);

    // Solve it!
    $solver = new Solver(Solver::MAX); // Can be either Solver::MIN for minimalization
    $solution = $solver->solve($problem);
    echo "ola1";
    echo $solution;
    echo "  ola2  ";
    var_dump($solution);
?>