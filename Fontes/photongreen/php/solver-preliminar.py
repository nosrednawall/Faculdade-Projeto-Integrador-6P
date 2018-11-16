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

  precoPainel = float(sys.argv[1])
  restricaoArea = float(sys.argv[2])
  tamanhoPainel = float(sys.argv[3])
  restricaoEnergia = float(sys.argv[4])
  potenciaPainel =  float(sys.argv[5])

  # cria as variaveis
  painel = solver.NumVar(-solver.infinity(), solver.infinity(), 'painel')

  # Primeira restricao : A Area de instalacao do painel
  constraint1 = solver.Constraint(-solver.infinity(), restricaoArea)
  constraint1.SetCoefficient(painel, tamanhoPainel)

  # Segunda restricao : Energia a ser alcancada com os paineis
  constraint2 = solver.Constraint(-solver.infinity(),restricaoEnergia)
  constraint2.SetCoefficient(painel, potenciaPainel)

  # Buguei1
  # # Terceira restricao: Maior que 0
  # constraint3 = solver.Constraint(0,solver.infinity())
  # constraint3.SetCoefficient(restricaoArea,1)
    
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
  inversor = (potenciaPainel * quantidadePaineis)/1000

  # gera o json com o resultado
  jsonString = json.dumps({
    "painel":potenciaPainel,
    "quantidadePaineis":quantidadePaineis,
    "areaUtilizadaPaineis":areaUtilizadaPaineis,
    "energiaGeradaPeinel":energiaGeradaPeinel,
    "precoTotalPaineis":precoTotalPaineis,
    "inversor": inversor
    })

  #Envio da solucao para o PHP
  print(jsonString)

  #historico de testes

  # restricaoPreco = float(sys.argv[1])

  # # Primeira restricao : O preço do painel
  # restricao1 = solver.Constraint(-solver.infinity(), restricaoPreco)
  # restricao1.SetCoefficient(painel, precoPainel )

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
