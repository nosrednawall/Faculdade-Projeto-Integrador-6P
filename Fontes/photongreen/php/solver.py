from __future__ import print_function
from ortools.linear_solver import pywraplp

  # x1 = painel
  # x2 = inversor

import sys


def main():
  # instancia o solver
  solver = pywraplp.Solver('LinearExample',
                           pywraplp.Solver.GLOP_LINEAR_PROGRAMMING)
  
  # cria as variaveis x1,x2,x3,xn
  painel = solver.NumVar(-solver.infinity(), solver.infinity(), 'painel')

  # primeira restricao de preco
  # for param in sys.argv:
  #   print(param)
  print(sys.argv[1:])
  restricao1 = solver.Constraint(-solver.infinity(), 1500)
  restricao1.SetCoefficient(painel, 690 )

  # Constraint 2: 1.6painel <= areaInformada
  constraint2 = solver.Constraint(-solver.infinity(), 20) #a area informada deve ser em metros quadrados
  constraint2.SetCoefficient(painel, 1.6)


  # Constraint 3: painel >= quantidadeDeEnergiaNecessariaParaGerar
  constraint3 = solver.Constraint(-solver.infinity(),2000)
  constraint3.SetCoefficient(painel, 250)
    
  # Objective function: z(MAX) = painel + inversor.
  objective = solver.Objective()
  objective.SetCoefficient(painel, 690)
  objective.SetMaximization()
  
  # Solve the system.
  solver.Solve()
  opt_solution = 690 * painel.solution_value()
  print('Number of variables =', solver.NumVariables())
  print('Number of constraints =', solver.NumConstraints())
  # The value of each variable in the solution.
  print('Solution:')
  print('painel = ', painel.solution_value())

  # The objective value of the solution.
  print('Optimal objective value =', opt_solution)
  
if __name__ == '__main__':
  main()
