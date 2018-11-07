from __future__ import print_function
from ortools.linear_solver import pywraplp


def main():
  # Instantiate a Glop solver, naming it LinearExample.
  solver = pywraplp.Solver('LinearExample',
                           pywraplp.Solver.GLOP_LINEAR_PROGRAMMING)
  
  # Create the variables x and y.
  x1 = solver.NumVar(-solver.infinity(), solver.infinity(), 'x1')
  x2 = solver.NumVar(-solver.infinity(), solver.infinity(), 'x2')


  
  # Constraint 1: 
  constraint1 = solver.Constraint(-solver.infinity(), 630)
  constraint1.SetCoefficient(x1, 0.7)
  constraint1.SetCoefficient(x2, 1)


  # Constraint 2:
  constraint2 = solver.Constraint(-solver.infinity(), 600)
  constraint2.SetCoefficient(x1, 0.5)
  constraint2.SetCoefficient(x2, 0.8)


  # Constraint 3: 
  constraint3 = solver.Constraint(-solver.infinity(), 700)
  constraint3.SetCoefficient(x1, 1)
  constraint3.SetCoefficient(x2, 0.6)
  
    # Constraint 4: 
  constraint4 = solver.Constraint(-solver.infinity(), 135)
  constraint4.SetCoefficient(x1, 0.1)
  constraint4.SetCoefficient(x2, 0.25)
  
  
  # Objective function: 3x + 4y.
  objective = solver.Objective()
  objective.SetCoefficient(x1, 10)
  objective.SetCoefficient(x2, 9)
  objective.SetMaximization()
  
  # Solve the system.
  solver.Solve()
  opt_solution = 10 * x1.solution_value() + 9 * x2.solution_value()
  print('Number of variables =', solver.NumVariables())
  print('Number of constraints =', solver.NumConstraints())
  # The value of each variable in the solution.
  print('Solution:')
  print('x1 = ', x1.solution_value())
  print('x2 = ', x2.solution_value())
  # The objective value of the solution.
  print('Optimal objective value =', opt_solution)
  
if __name__ == '__main__':
  main()
