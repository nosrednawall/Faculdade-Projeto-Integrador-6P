#encoding: utf-8
from __future__ import print_function
from ortools.linear_solver import pywraplp

import sys
import json

# Classe responsavel por responder a equacao abaixo

def main():
  # instancia o solver
  solver = pywraplp.Solver('LinearExample', pywraplp.Solver.GLOP_LINEAR_PROGRAMMING)

  # Atribuindo valores recebidos em variaveis
  restricaoPreco = float(sys.argv[1])
  precoPainel = float(sys.argv[2])
  restricaoArea = float(sys.argv[3])
  tamanhoPainel = float(sys.argv[4])
  restricaoEnergia = float(sys.argv[5])
  potenciaPainel =  float(sys.argv[6])

  # cria as variaveis
  painel = solver.NumVar(-solver.infinity(), solver.infinity(), 'painel')

  # Primeira restricao : O preço do painel
  restricao1 = solver.Constraint(-solver.infinity(), restricaoPreco)
  restricao1.SetCoefficient(painel, precoPainel )

  # Segunda restricao : A Area de instalacao do painel
  constraint2 = solver.Constraint(-solver.infinity(), restricaoArea)
  constraint2.SetCoefficient(painel, tamanhoPainel)

  # Terceira restricao : Energia a ser alcancada com os paineis
  constraint3 = solver.Constraint(-solver.infinity(),restricaoEnergia)
  constraint3.SetCoefficient(painel, potenciaPainel)
    
  # Funcao Objetivo
  objective = solver.Objective()
  objective.SetCoefficient(painel, precoPainel)
  objective.SetMaximization()
  
  # Execucao do solver
  solver.Solve()

  # Gerando valores que utilizaremos
  precoTotalPaineis = precoPainel * painel.solution_value()
  areaUtilizadaPaineis = tamanhoPainel * painel.solution_value()
  energiaGeradaPeinel = potenciaPainel * painel.solution_value()
  quantidadePaineis = painel.solution_value()

  # gera o json com o resultado
  jsonString = json.dumps({
    "painel":potenciaPainel,
    "quantidadePaineis":quantidadePaineis,
    "areaUtilizadaPaineis":areaUtilizadaPaineis,
    "energiaGeradaPeinel":energiaGeradaPeinel,
    "precoTotalPaineis":precoTotalPaineis
    })

  #Envio da solucao para o PHP
  print(jsonString)

  #historico de testes

  # primeira restricao de preco
  # for param in sys.argv:
  #   print(param)

  #imprimir a quantidade de variaveis
  # print('Number of variables =', solver.NumVariables())
  # print('Number of constraints =', solver.NumConstraints())

  #todas as variaveis so que estaticas
  # restricaoPreco = 9000
  # precoPainel = 690
  # restricaoArea = 40
  # tamanhoPainel = 2
  # restricaoEnergia = 20000
  # potenciaPainel =  330


  # #Envio da solucao para o PHP
  # print('A potencia de painel escolhida foi de :', potenciaPainel)
  # print('quantidade de paineis = ', quantidadePaineis)
  # print('preço total de paineis =', precoTotalPaineis)
  # print('a área utilizada pelos paineis será de: ', areaUtilizadaPaineis)
  # print('A energia gerada pelos peines será de: ', energiaGeradaPeinel)


# from __future__ import print_function
# from ortools.linear_solver import pywraplp

# def main():
#   solver = pywraplp.Solver('SolveSimpleSystem',
#                            pywraplp.Solver.GLOP_LINEAR_PROGRAMMING)
#   # Create the variables x and y.
#   x = solver.NumVar(0, 1, 'x')
#   y = solver.NumVar(0, 2, 'y')
#   # Create the objective function, x + y.
#   objective = solver.Objective()
#   objective.SetCoefficient(x, 1)
#   objective.SetCoefficient(y, 1)
#   objective.SetMaximization()
#   # Call the solver and display the results.
#   solver.Solve()
#   print('Solution:')
#   print('x = ', x.solution_value())
#   print('y = ', y.solution_value())

# if __name__ == '__main__':
#   main()

if __name__ == '__main__':
  main()
