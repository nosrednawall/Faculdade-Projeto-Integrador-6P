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
    #adicionado + 25% a restricao de energia para o resulta não der placas muito abaixo do necessário
    restricaoEnergia = float(sys.argv[4]) + (float(sys.argv[4]) * 0.25)
    potenciaPainel =  float(sys.argv[5])

    # cria as variaveis
    painel = solver.IntVar(-solver.infinity(), solver.infinity(), 'painel')

    # Primeira restricao : A Area de instalacao do painel
    constraint1 = solver.Constraint(-solver.infinity(), restricaoArea)
    constraint1.SetCoefficient(painel, tamanhoPainel)

    # Segunda restricao : Energia a ser alcancada com os paineis
    constraint2 = solver.Constraint(-solver.infinity(),restricaoEnergia)
    constraint2.SetCoefficient(painel, potenciaPainel)
      
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
    inversorMinimo = restricaoEnergia  - (restricaoEnergia * 0.20)
    inversorMaximo =  restricaoEnergia + (restricaoEnergia * 0.20)
    inversorRecomendado = restricaoEnergia


    # gera o json com o resultado
    jsonString = json.dumps({
      "placaPotencia":potenciaPainel,
      "placaQuantidade":quantidadePaineis,
      "placaArea":areaUtilizadaPaineis,
      "placaPrecoUnitario": precoPainel,
      "placaPrecoTotal":precoTotalPaineis,
      "placaEnergiaGerada":energiaGeradaPeinel,
      "inversorMinimo": inversorMinimo,
      "inversorMaximo": inversorMaximo,
      "inversorRecomendado": inversorRecomendado
    })

    #Envio da solucao para o PHP
    print(jsonString)

if __name__ == '__main__':
  main()
