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

  restricao1 = solver.Constraint(-solver.infinity(), float(sys.argv[1]))
  restricao1.SetCoefficient(painel, float(sys.argv[2]) )

  # Constraint 2: 1.6painel <= areaInformada
  constraint2 = solver.Constraint(-solver.infinity(), float(sys.argv[3])) #a area informada deve ser em metros quadrados
  constraint2.SetCoefficient(painel, float(sys.argv[4]))


  # Constraint 3: painel >= quantidadeDeEnergiaNecessariaParaGerar
  constraint3 = solver.Constraint(-solver.infinity(),float(sys.argv[5]))
  constraint3.SetCoefficient(painel, float(sys.argv[6]))
    
  # Objective function: z(MAX) = painel + inversor.
  objective = solver.Objective()
  objective.SetCoefficient(painel, float(sys.argv[2]))
  objective.SetMaximization()
  
  # Solve the system.
  solver.Solve()
  opt_solution = float(sys.argv[2]) * painel.solution_value()
  print('Number of variables =', solver.NumVariables())
  print('Number of constraints =', solver.NumConstraints())
  # The value of each variable in the solution.
  print('Solution:')
  print('painel = ', painel.solution_value())

  # The objective value of the solution.
  print('Optimal objective value =', opt_solution)
  
if __name__ == '__main__':
  main()
