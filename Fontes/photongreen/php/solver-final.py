# #encoding: utf-8
# from __future__ import print_function
# from ortools.linear_solver import pywraplp

# import sys
# import json

# # Classe responsavel efetuar o solver final para identificar qual o melhor tipo de painel para o problema do usuario

# def main():
#   # instancia o solver
#   solver = pywraplp.Solver('LinearExample', pywraplp.Solver.GLOP_LINEAR_PROGRAMMING)

#   # Atribuindo valores recebidos em variaveis
#   valorInversor = float(sys.argv[1])
#   restricaoPreco = float(sys.argv[2])
#   precoPainel = float(sys.argv[3])

#   # cria as variaveis
#   painel1 = solver.NumVar(-solver.infinity(), solver.infinity(), 'painel250')
#   painel2 = solver.NumVar(-solver.infinity(), solver.infinity(), 'painel270')
#   painel3 = solver.NumVar(-solver.infinity(), solver.infinity(), 'painel325')
#   painel4 = solver.NumVar(-solver.infinity(), solver.infinity(), 'painel330')
#   inversor = solver.NumVar(-solver.infinity(), solver.infinity(), 'inversor')


#   # Primeira restricao : O preço 
#   restricao1 = solver.Constraint(-solver.infinity(), restricaoPreco)
#   restricao1.SetCoefficient(painel1, precoPainel )
#   restricao1.SetCoefficient(painel2, precoPainel2 )
#   restricao1.SetCoefficient(painel3, precoPainel3 )
#   restricao1.SetCoefficient(painel4, precoPainel4 )
#   restricao1.SetCoefficient(inversor, valorInversor )
    
#   # Funcao Objetivo
#   objective = solver.Objective()
#   objective.SetCoefficient(painel, precoPainel)
#   objective.SetMaximization()
  
#   # Execucao do solver
#   solver.Solve()

#   # Gerando valores que utilizaremos
#   precoTotalPaineis = precoPainel * painel.solution_value()
#   areaUtilizadaPaineis = tamanhoPainel * painel.solution_value()
#   energiaGeradaPeinel = potenciaPainel * painel.solution_value()
#   quantidadePaineis = painel.solution_value()

#   # gera o json com o resultado
#   jsonString = json.dumps({
#     "painel":potenciaPainel,
#     "quantidadePaineis":quantidadePaineis,
#     "areaUtilizadaPaineis":areaUtilizadaPaineis,
#     "energiaGeradaPeinel":energiaGeradaPeinel,
#     "precoTotalPaineis":precoTotalPaineis
#     })

#   #Envio da solucao para o PHP
#   print(jsonString)

# if __name__ == '__main__':
#   main()
