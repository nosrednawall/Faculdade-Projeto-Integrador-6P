from __future__ import print_function
from ortools.linear_solver import pywraplp


def main():
  # Instantiate a Glop solver, naming it LinearExample.
  solver = pywraplp.Solver('LinearExample',
                           pywraplp.Solver.GLOP_LINEAR_PROGRAMMING)
  
  # Create the variables x and y.
  painel1 = solver.NumVar(-solver.infinity(), solver.infinity(), 'painel1')
  inversor = solver.NumVar(-solver.infinity(), solver.infinity(), 'inversor')

#painel 230w

  # Constraint 1: 600painel1 + 6000inversor <-15000
  constraint1 = solver.Constraint(-solver.infinity(), 15000)
  constraint1.SetCoefficient(painel1, 600 )
  constraint1.SetCoefficient(inversor, 6000)


  # Constraint 2: 1.6painel1 <= areaInformada
  constraint2 = solver.Constraint(-solver.infinity(), 10) #a area informada deve ser em metros quadrados
  constraint2.SetCoefficient(painel1, 1.6)


  # Constraint 3: painel1 >= quantidadeDeEnergiaNecessariaParaGerar
  constraint3 = solver.Constraint(-solver.infinity(),2000)
  constraint3.SetCoefficient(painel1, 230)
  
  # # Constraint 4: inversor >= 1
  # constraint3 = solver.Constraint(1,solver.infinity())
  # constraint3.SetCoefficient(inversor, 1)

  # # Constraint 4: inversor <2 
  # constraint3 = solver.Constraint(-solver.infinity(),2)
  # constraint3.SetCoefficient(inversor, 1)

  # # Constraint 4: 
  # constraint4 = solver.Constraint(0 ,solver.infinity())
  # constraint4.SetCoefficient(x1, 0.1)
  # constraint4.SetCoefficient(x2, 0.25)
  
  
  # Objective function: z(MAX) = painel1 + inversor.
  objective = solver.Objective()
  objective.SetCoefficient(painel1, 600)
  objective.SetCoefficient(inversor, 6000)
  objective.SetMaximization()
  
  # Solve the system.
  solver.Solve()
  opt_solution = 600 * painel1.solution_value() + 6000 * inversor.solution_value()
  print('Number of variables =', solver.NumVariables())
  print('Number of constraints =', solver.NumConstraints())
  # The value of each variable in the solution.
  print('Solution:')
  print('painel1 = ', painel1.solution_value())
  print('inversor = ', inversor.solution_value())
  # The objective value of the solution.
  print('Optimal objective value =', opt_solution)
  
if __name__ == '__main__':
  main()
