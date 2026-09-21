using System;
public class Pilha<T>
{
    private class No { public T Valor; public No? Proximo; public No(T valor) { Valor = valor; } }
    private No? topo;
    public int Count { get; private set; }
    public void Push(T valor)
    {
        topo = new No(valor) { Proximo = topo }; // O novo nó aponta para o antigo topo.
        Count++;
    }
    public T Peek()
    {
        if (topo == null) throw new InvalidOperationException("Pilha vazia.");
        return topo.Valor;
    }
    public T Pop()
    {
        T valor = Peek();
        topo = topo!.Proximo; // O próximo nó assume o topo.
        Count--;
        return valor;
    }
}
public class Program
{
    public static void Main()
    {
        var pilha = new Pilha<int>();
        pilha.Push(10); pilha.Push(20); pilha.Push(30);
        Console.WriteLine(pilha.Pop());  // 30
        Console.WriteLine(pilha.Peek()); // 20
        Console.WriteLine(pilha.Count);  // 2
    }
}
