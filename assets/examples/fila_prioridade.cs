using System;
public class FilaPrioridade<T>
{
    private class No
    {
        public T Valor; public int Prioridade; public No? Proximo;
        public No(T valor, int prioridade) { Valor = valor; Prioridade = prioridade; }
    }
    private No? inicio;
    public int Count { get; private set; }
    // Convenção: números maiores representam prioridades maiores.
    public void Enqueue(T valor, int prioridade)
    {
        var novo = new No(valor, prioridade);
        if (inicio == null || prioridade > inicio.Prioridade)
        {
            novo.Proximo = inicio;
            inicio = novo;
        }
        else
        {
            var atual = inicio;
            // Passa também pelos nós de mesma prioridade: preserva FIFO nos empates.
            while (atual.Proximo != null && atual.Proximo.Prioridade >= prioridade)
                atual = atual.Proximo;
            novo.Proximo = atual.Proximo;
            atual.Proximo = novo;
        }
        Count++;
    }
    public T Peek()
    {
        if (inicio == null) throw new InvalidOperationException("Fila vazia.");
        return inicio.Valor;
    }
    public T Dequeue()
    {
        var valor = Peek();
        inicio = inicio!.Proximo;
        Count--;
        return valor;
    }
}
public class Program
{
    public static void Main()
    {
        var fila = new FilaPrioridade<string>();
        fila.Enqueue("A", 2); fila.Enqueue("B", 5); fila.Enqueue("C", 5);
        Console.WriteLine(fila.Dequeue()); // B
        Console.WriteLine(fila.Dequeue()); // C: chegou depois de B.
        Console.WriteLine(fila.Dequeue()); // A
    }
}
